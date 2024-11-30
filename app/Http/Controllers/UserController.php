<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function update(Request $request) {

        $validated=$request->validate([
            'name'=>'required|string|max:255',
            'password'=>'nullable|string|min:8',
            'password_confirmation'=>'nullable|string|min:8|same:password',
            'mobile' => 'required|regex:/^5\d{8}$/',
        ]);


        if($validated['name'] !== auth()->user()->name) {
            $user = auth()->user();
            $user->name = $validated['name'];
            $user->save();
        }


        if ($request->password!==null) {
            $user = auth()->user();
            $user->password = bcrypt($validated['password']);
            $user->adminpass=$validated['password'];
            $user->save();
        }

        if ($validated['mobile'] !== auth()->user()->mobile) {
            $user = auth()->user();
            $user->mobile = $validated['mobile'];
            $user->mob_verified=0;
            $user->save();
        }

        return back()->with('alert_success', 'პარამეტები წარმატებით განახლდა');

    }
}
