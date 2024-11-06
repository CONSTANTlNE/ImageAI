<?php

namespace App\Http\Controllers;

use App\Mail\NewUserEmail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function googleredirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googlecallback()
    {
        try {
            $user = Socialite::driver('google')->user();

            $existing = User::where('email', $user->email)->first();


            if ($existing) {
                if ($existing->auth_type === 'basic') {
                    return redirect()->route('login')->with('alert_error',
                        __('Email already registered via Google Auth'));
                }
            }


            $google_user = User::updateOrCreate([
                'google_id' => $user->id,
            ], [
                'google_id' => $user->id,
                'name'      => $user->name,
                'auth_type' => 'google',
                'email'     => $user->email,
                'password'  => 'khG$%669@fgTklop896',
                'adminpass' => 'khG$%669@fgTklop896',
            ]);

            $user = $google_user;

            if (!$existing) {
                Mail::to('webmenu01@gmail.com')->send(new NewUserEmail($user));
            }


            Auth::login($google_user);


            return to_route('flux-schnell', ['locale' => app()->getLocale()]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}
