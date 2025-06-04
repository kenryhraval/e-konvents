<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

    // as we are not working with a resource anymore, the naming convention may be changed
    public function showLogin()
    {
        return view('auth.login');
    }
    
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            return redirect()->route('events.index')->with('success', 'Logged in!');  //->intended
        }

        throw ValidationException::withMessages([
            'email' => 'Sorry, incorrect credentials'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // remove all data
        $request->session()->invalidate();
        // // a layer of sequrity
        $request->session()->regenerateToken();

        return redirect()->route('show.login');
    }
}
