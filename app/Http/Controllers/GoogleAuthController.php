<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class GoogleAuthController extends Controller
{
 
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        if (request()->has('error')) {
            return redirect()->route('show.login')->withErrors(__('Google login was cancelled'));
        }

        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('show.login')->withErrors(__('Google login failed'));
        }

        if (Auth::check()) {
            // --- LINKING: Logged-in user wants to connect their Google account
            $user = Auth::user();

            // Prevent linking if it's already linked to another account
            $existing = User::where('google_id', $googleUser->getId())->first();
            if ($existing && $existing->id !== $user->id) {
                return redirect()->route('users.show', $user)->withErrors(__('This Google account is already linked to another user.'));
            }

            // Link
            $user->google_id = $googleUser->getId();
            $user->google_avatar = $googleUser->getAvatar();
            $user->save();

            return redirect()->route('users.show', $user)->with('success', __('Google account linked!'));
        } else {
            // --- LOGIN: Not logged in, attempt to authenticate with Google

            // Find user by email
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                return redirect()->route('show.login')->withErrors(__('No user with this email exists in the system'));
            }

            // Optionally: link Google if it's not already linked
            if (!$user->google_id) {
                $user->google_id = $googleUser->getId();
                $user->google_avatar = $googleUser->getAvatar();
                $user->save();
            }

            // Login
            Auth::login($user, true);

            return redirect()->intended(route('events.index'))->with('success', __('Logged in with Google!'));
        }
    }





}
