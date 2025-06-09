<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;


class GoogleAuthController extends Controller
{
 
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        if (request()->has('error')) {
            return redirect()
                ->route('users.index') 
                ->withErrors(__('Google login was cancelled'));
        }

        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()
                ->route('users.index') // or fallback route
                ->withErrors(__('Google login failed'));
        }

        // Find user by email
        $user = User::where('email', $googleUser->getEmail())->first();

        if ($user) {
            $user->google_id = $googleUser->getId();
            $user->google_avatar = $googleUser->getAvatar();
            $user->save();

            return redirect()->route('users.show', $user)->with('success', __('Google account linked!'));
        } else {
            return redirect()
                ->route('users.index')
                ->withErrors(__('No user with this email exists in the system'));
        }
    }



}
