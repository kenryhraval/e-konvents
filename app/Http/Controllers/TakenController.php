<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Taken;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class TakenController extends Controller
{
    public function index()
    {
        $taken = Taken::with(['user', 'item'])->latest()->get();

        return view('taken.index', compact('taken'));
    }

    public function store(Request $request, Item $item)
    {
        $validated = $request->validate([
            'count' => 'required|integer|min:1',
            'reason' => 'required|string|max:255',
        ]);

        $user = auth::user();
        $totalCost = $item->price * $validated['count'];
        $newBalance = $user->balance - $totalCost;

        // Check if new balance would exceed the user's role-based limit
        if ($newBalance < $user->maxRoleBalanceLimit()) {
            return redirect()->back()->withErrors([
                'balance' => __('You cannot take this item. It would exceed your allowed negative balance.'),
            ]);
        }

        // Create Taken record
        Taken::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
            'count' => $validated['count'],
            'reason' => $validated['reason'],
        ]);

        // Update user balance
        $user->update(['balance' => $newBalance]);

        return redirect()->route('items.index')->with('success', __('Item taken and logged'));
    }


}
