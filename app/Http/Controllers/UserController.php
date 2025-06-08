<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use App\Models\User;
use App\Models\RoleType;
use App\Mail\PasswordMail;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {

        $query = User::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('role_types')) {
            $query->whereHas('positions', function ($q) use ($request) {
                $q->whereIn('role_type_id', $request->role_types);
            });
        }


        
        $users = $query->paginate(20);
        return view('users.index', compact('users'));
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
            'email' => 'required|string|email|max:255|unique:users,email,',
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
    
        return redirect()->route('users.index')->with('success', __('User registered'));
    }

    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }

    public function edit(User $user)
    {
        $roleTypes = RoleType::orderBy('name')->get();
        $adminRoles = ['admin', 'item', 'event'];

        return view('users.edit', compact('user', 'roleTypes', 'adminRoles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'email' => 'required|email|max:255|unique:users,email,' . $user->id, 
            'password' => 'nullable|min:10|confirmed',
            'phone_number' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'balance' => 'nullable|numeric|min:0',
            'admin_types' => 'nullable|array',
            'admin_types.*' => 'in:admin,item,event,base',
            'positions' => 'array',
            'positions.*' => 'exists:role_types,id',
        ]);

        $userData = $request->only(['name', 'email', 'phone_number', 'address', 'balance']);

        if ($request->filled('password')) {
            $userData['password'] = bcrypt($request->password);
        }

        $user->update($userData);

        // Update admin roles
        // First delete old ones:
        $user->admins()->delete();
        // Then insert new ones if present:
        if (!empty($request['admin_types'])) {
            foreach ($request['admin_types'] as $type) {
                $user->admins()->create(['type' => $type]);
            }
        }

        // Update Positions
        $user->positions()->delete();
        if (!empty($request['positions'])) {
            foreach ($request['positions'] as $roleTypeId) {
                $user->positions()->create(['role_type_id' => $roleTypeId]);
            }
        }

        return redirect()->route('users.show', $user)->with('success', __('User updated'));
    }

    // Delete a user (admin only)
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', __('User deleted'));
    }
}
