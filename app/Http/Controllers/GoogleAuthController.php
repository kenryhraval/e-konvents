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
        $googleUser = Socialite::driver('google')->user();

        // Find user by email
        $user = User::where('email', $googleUser->getEmail())->first();

        if ($user) {
            // Save google ID and optionally avatar
            $user->google_id = $googleUser->getId();
            $user->google_avatar = $googleUser->getAvatar();
            $user->save();

            return redirect()->route('users.show', $user)->with('success', __('Google account linked!'));

        } else {

            // Redirect somewhere safe like dashboard or home
            return redirect()->route('users.index')->withErrors(__('No user with this email exists in the system.'));
        }

    }

}
