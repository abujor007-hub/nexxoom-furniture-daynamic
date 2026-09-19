<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

  
        $user = User::where('email', $googleUser->email)->first();

        if ($user) {

         
            $user->update([
                'google_id' => $googleUser->id,
            ]);
        } else {

      
            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'password' => bcrypt(str()->random(24)),
            ]);
        }

    
        Auth::login($user);

 
        return redirect()->intended('home');
    }
}
