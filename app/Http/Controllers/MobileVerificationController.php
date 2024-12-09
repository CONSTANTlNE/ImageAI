<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MobileVerificationController extends Controller
{
    public function index()
    {
        return view('landingpages.verify');
    }

    public function storeMobile(Request $request)
    {
        $request->validate([
            'mobile' => 'required|regex:/^5\d{8}$/',
        ]);

        $user = auth()->user();
        if ($user && !$user->mob_verified) {
            $random = random_int(1000, 9999);

            $user->mobile   = $request->mobile;
            $user->sms_code = $random;
            $user->save();

            // SEND SMS NOTIFICATION

            $text1 = 'ვერიფიკაციის კოდი';
            $text2 = $random;
//          $text3 = 'https://imageai.test/midjourney';

            $sendsms = $text1."\n\n".$text2."\n\n";

            $url = 'https://api.ubill.dev/v1/sms/send';

            $params = [
                'key'      => config('apikeys.ubill'),
                'brandID'  => 2,
                'numbers'  => '995'.$request->mobile,
                'text'     => $sendsms,
                'stopList' => false,
            ];

            $response2 = Http::get($url, $params);

            return back()->with('alert_success', 'ვერიფიკაციის კოდი გამოგზავნილია');
        } else {
            return back()->with('alert_error', 'ვერიფიკაციის კოდი უკვე გამოგზავნილია');
        }
    }

    public function changeMobile(Request $request)
    {

        $user = auth()->user();
        if ($user && !$user->mob_verified) {
            $user->mobile =null;
            $user->sms_code =null;
            $user->save();
        }

        return redirect()->route('verify.mobile.index');
    }

    public function codeResend(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $random         = random_int(1000, 9999);
            $user->sms_code = $random;
            $user->save();

            // SEND SMS NOTIFICATION

            $text1 = 'ვერიფიკაციის კოდი';
            $text2 = $random;
//          $text3 = 'https://imageai.test/midjourney';

            $sendsms = $text1."\n\n".$text2."\n\n";

            $url = 'https://api.ubill.dev/v1/sms/send';

            $params = [
                'key'      => config('apikeys.ubill'),
                'brandID'  => 2,
                'numbers'  => '995'.$user->mobile,
                'text'     => $sendsms,
                'stopList' => false,
            ];

            $response2 = Http::get($url, $params);

            if ($response2->status() == 200) {
                return back()->with('alert_success', 'ვერიფიკაციის კოდი გამოგზავნილია');
            } else {
                return $response2->json();
            }
        }
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);

        if ($request->code != auth()->user()->sms_code) {
            return back()->with('alert_error', 'ვერიფიკაციის კოდი არასწორია');
        } else {
            $user = auth()->user();
            if ($user) {
                $user->mob_verified = 1;
                $user->save();
            }
            return redirect()->route('flux-schnell');
        }
    }
}
