<?php

namespace App\Http\Controllers;

use App\Models\UserBalance;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BogController extends Controller
{
    public function bogAuth(Request $request)
    {
        $clientId     = config('apikeys.BOG_ID');
        $clientSecret = config('apikeys.BOG_SECRET');

        $client   = new Client();
        $response = $client->post('https://oauth2.bog.ge/auth/realms/bog/protocol/openid-connect/token', [
            'auth'        => [$clientId, $clientSecret],
            'form_params' => [
                'grant_type' => 'client_credentials',
            ],
            'headers'     => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
        ]);

        $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);


//        dd($data['access_token']);

        if ($data) {
            $token = $data['access_token'];
            session(['token' => $token]);
        }

        return response('OK', 200);
    }

    public function sendPaymentRequest(Request $request)
    {

        $amount = 0.05;
        $userid = auth()->user()->id;

        $client = new Client();

        $response = $client->post('https://api.bog.ge/payments/v1/ecommerce/orders', [
            'headers' => [
                'Accept-Language' => 'ka',
                'Authorization'   => 'Bearer '.session('token'),
                'Content-Type'    => 'application/json',
            ],
            'json'    => [
                'buyer'             => [
                    'full_name' => '',
                ],
                'capture'           => 'automatic',
                'callback_url'      => 'https://local.ews.ge/api/bog/webhook',
                'external_order_id' => $userid,
                'purchase_units'    => [
                    'currency'     => 'GEL',
                    'total_amount' => $amount,
                    'basket'       => [
                        [
                            'quantity'    => 1,
                            'unit_price'  => $amount,
                            'total_price' => $amount,
                            'product_id'=>'balance',
                            'tin'         => auth()->user()->id,
                        ],
                    ],
                ],
                'redirect_urls'     => [
                    'fail'    => 'https://google.com',
                    'success' => 'https://local.ews.ge',
                ],
            ],
        ]);

        $body = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

//        dd($body['_links']['redirect']['href']);


        return redirect($body['_links']['redirect']['href']);
    }

    public function webhook(Request $request)
    {

        $data = $request->body;

        $order_id = $data['order_id'];

        $clientId     = config('apikeys.BOG_ID');
        $clientSecret = config('apikeys.BOG_SECRET');


        $client   = new Client();
        $response = $client->post('https://oauth2.bog.ge/auth/realms/bog/protocol/openid-connect/token', [
            'auth'        => [$clientId, $clientSecret],
            'form_params' => [
                'grant_type' => 'client_credentials',
            ],
            'headers'     => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
        ]);

        $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        $token = $data['access_token'];


        // Get Payment Details from BOG
        $response2 = Http::withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->get('https://api.bog.ge/payments/v1/receipt/'.$order_id);


        $finaldata = json_decode($response2->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        $random=random_int(1000,90000);
        Log::channel('api_requests')->info($random.' '.'Get Details From Bank', ['Payment Details' => $finaldata]);
        Log::channel('api_requests')->info($random.' '.'order_status', ['status' => $finaldata['order_status']['key']]);
        Log::channel('api_requests')->info($random.' '.'restaurant id', ['id' => $finaldata['external_order_id']]);
        Log::channel('api_requests')->info($random.' '.'package',
            ['package' => $finaldata['purchase_units']['items'][0]['package_code']]);
        Log::channel('api_requests')->info('user id',
            ['user' => $finaldata['purchase_units']['items'][0]['tin']]);

        $status       = $finaldata['order_status']['key'];
        $plan         = $finaldata['purchase_units']['items'][0]['package_code'];
        $userid = $finaldata['external_order_id'];
        $userID       = $finaldata['purchase_units']['items'][0]['tin'];
        $amount       = $finaldata['purchase_units']['items'][0]['total_price'];

        UserBalance::withoutGlobalScopes()->create([
            'user_id' => $userid,
            'balance' => $amount,
            'model'=>'fill'
        ]);

        return  response('ok',200);
    }

}
