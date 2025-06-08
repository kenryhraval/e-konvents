<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleType;

class RoleTypeController extends Controller
{
    public function index()
    {
        return view('roles.index', ['roles' => RoleType::all()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:role_types,name',
            'min_balance' => 'required|numeric',
        ]);

        RoleType::create($validated);
        return back()->with('success', __('Role added successfully'));
    }

    public function update(Request $request, RoleType $role)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'min_balance' => 'required|numeric',
        ]);

        $role->update($validated);
        return back()->with('success', __('Role updated successfully'));
    }

    public function destroy(RoleType $role)
    {
        $role->delete();
        return back()->with('success', __('Role deleted successfully'));
    }

}
