<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use App\Models\User;
use App\Mail\PasswordMail;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'birthdate' => 'nullable|date',
        ]);
    
        $password = Str::random(10);
    
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'birthdate' => $validated['birthdate'],
            'password' => Hash::make($password),
        ]);

        // Auth::login($user);
    
        // send the password to the user and store just the hash locally
        Mail::to($user->email)->send(new PasswordMail($user, $password));

        // $user->roles()->sync($request->roles);
    
        return redirect()->route('users.index')->with('success', 'User registered!');
    }

    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }

    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'email' => 'required|email|max:255', 
            'password' => 'nullable|min:10|confirmed',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'balance' => 'nullable|numeric|min:0',
        ]);

        $userData = $request->only(['name', 'email', 'phone', 'address', 'balance']);

        if ($request->filled('password')) {
            $userData['password'] = bcrypt($request->password);
        }

        $user->update($userData);

        return redirect()->route('events.index')->with('success', 'User updated!'); //->intended()
    }

    // Delete a user (admin only)
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted!');
    }
}
