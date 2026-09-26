<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Redirect User to Google Login
     */
    public function redirect()
    {
        return Socialite::driver('google')
            ->with([
                'prompt' => 'select_account',
            ])
            ->redirect();
    }

    /**
     * Google Login Callback
     */
    public function callback()
    {
        // Get Google User
        $googleUser = Socialite::driver('google')->user();

        // Find User by Email
        $user = User::where(
            'email',
            $googleUser->email
        )->first();

        /*
        |--------------------------------------------------------------------------
        | Existing User
        |--------------------------------------------------------------------------
        */

        if ($user) {

            $user->update([
                'google_id' => $googleUser->id,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | New User
        |--------------------------------------------------------------------------
        */

        else {

            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'password' => bcrypt(
                    str()->random(24)
                ),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Login User
        |--------------------------------------------------------------------------
        */

        Auth::login($user);

        /*
        |--------------------------------------------------------------------------
        | Redirect to Home Page
        |--------------------------------------------------------------------------
        */

        return redirect()->route('home.page');
    }
}