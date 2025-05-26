<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Taken;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class TakenController extends Controller
{
    public function store(Request $request, $itemId)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'count' => 'required|integer|min:1',
            'reason' => 'required|string|max:255',
        ]);

        Taken::create([
            'user_id' => Auth::id(),
            'item_id' => $validated['item_id'],
            'count' => $validated['count'],
            'reason' => $validated['reason'],
        ]);

        return redirect()->route('items.index')->with('success', 'Item taken and logged.');
    }
}
