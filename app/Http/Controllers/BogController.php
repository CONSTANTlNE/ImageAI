<?php

namespace App\Http\Controllers;

use App\Models\UserBalance;
use App\Services\BogService;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BogController extends Controller
{
    public function bogAuth(Request $request)
    {

        (new BogService())->BogAuth();

        return response('OK', 200);
    }

    public function sendPaymentRequest(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:3',
        ]);

        $amount = 0.05;

        $redirectUrl = (new BogService())->PaymentRequest($amount, auth()->user()->id);

        if ($redirectUrl) {
            return redirect($redirectUrl); // Perform the redirect
        } else {
            return back()->with('alert_error', 'გადახდისას დაფიქსირდა შეცდომა'); // If no redirect URL, show an error
        }

    }

    public function getPaymentStatus(Request $request)
    {
        $data = $request->body;

        $order_id = $data['order_id'];

        $finaldata = (new BogService())->GetPaymentStatus($order_id);

        $random    = random_int(1000, 90000);

        Log::channel('bog_payment_request')->info($random.' '.'Get Details From Bank', ['Payment Details' => $finaldata]);
        Log::channel('bog_payment_request')->info($random.' '.'order_status', ['status' => $finaldata['order_status']['key']]);
        Log::channel('bog_payment_request')->info($random.' '.'restaurant id', ['id' => $finaldata['external_order_id']]);
        Log::channel('bog_payment_request')->info($random.' '.'package',
            ['package' => $finaldata['purchase_units']['items'][0]['package_code']]);
        Log::channel('bog_payment_request')->info('user id',
            ['user' => $finaldata['purchase_units']['items'][0]['tin']]);

        $status = $finaldata['order_status']['key'];
        $plan   = $finaldata['purchase_units']['items'][0]['package_code'];
        $userid = $finaldata['external_order_id'];
        $userID = $finaldata['purchase_units']['items'][0]['tin'];
        $amount = $finaldata['purchase_units']['items'][0]['total_price'];

        UserBalance::withoutGlobalScopes()->create([
            'user_id' => $userid,
            'balance' => $amount,
            'model'   => 'fill',
            'bank'    => 'bog',
            'returnable' => $amount,
            'transaction_id' => $finaldata['order_id'],
        ]);

        return response('ok', 200);
    }

    public function userRequest(Request $request)
    {
        $balance      = round(Userbalance::sum('balance'), 2, PHP_ROUND_HALF_DOWN);

        if ($balance<3) {
            return back()->with('alert_error','თანხის დაბრუნება შესაძლებელია თუ ბალანსი აღემატება 3 ლარს და დასაბრუნებელი თანხა 1 ლარზე მეტია');
        }

        if ($balance-3<1) {
            return back()->with('alert_error','დსდსდ');
        }

        $fills=UserBalance::where('user_id', auth()->user()->id)
            ->where('model', 'fill')
            ->whereNotNull('refundable')
            ->get();


        $returnamount = 0.23;

        foreach ($fills as $fill) {
            // If no return amount is left, stop updating further records
            if ($returnamount <= 0) {
                break;
            }
            // If the refundable amount is less than or equal to the remaining return amount
            if ($fill->refundable <= $returnamount) {
                $returnamount -= $fill->refundable; // Deduct the full refundable
                // fill->refundable should be refunded
                $response=  (new BogService())->Refund($fill->transaction_id, $fill->refundable);
                if (!isset($response['key'])){
                    Log::channel('bog_refund_request')->info('Refund'.' '.'user: '.auth()->user()->id.' '.auth()->user()->email, ['Details' => $response]);
                }

                // Deduct From Balance
                $userbalance=UserBalance::create(
                    [
                        'user_id' => auth()->user()->id,
                        'balance' =>-$fill->refundable,
                        'model'   => 'refund',
                        'transaction_id' => $fill->transaction_id
                    ]
                );

                $fill->refundable = null;// Mark as fully used

            } else {
                // Handle the last partial refund
                $fill->refundable -= $returnamount; // Deduct only the remaining amount
                // only whats left of returnamount should be returned
                $response=  (new BogService())->Refund($fill->transaction_id, $returnamount);
                if (!isset($response['key'])){
                    Log::channel('bog_refund_request')->info('Refund Error'.' '.'user: '.auth()->user()->id.' '.auth()->user()->email, ['Details' => $response]);
                }
                // Deduct From Balance
                $userbalance=UserBalance::create(
                    [
                        'user_id' => auth()->user()->id,
                        'balance' =>-$returnamount,
                        'model'   => 'refund',
                        'transaction_id' => $fill->transaction_id
                    ]
                );
                $fill->refundable = $returnamount;
            }
            // Save the changes to the database
            $fill->save();
        }


//        $returnamount = $balance-3;

        return $returnamount;
    }

}
