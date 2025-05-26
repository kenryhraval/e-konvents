<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $items = Item::paginate(20);
        // return view('items.index', compact('items'));

        $query = Item::query();

        // Filter by search term (name)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }

        // Sort by price if requested
        if ($request->boolean('sortByCost')) {
            $query->orderBy('price');
        }

        $items = $query->paginate(20)->withQueryString();;

        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
        ]);
    
        // create and save the new item
        Item::create($validated);
    
        return redirect()->route('items.index')->with('success', 'Item created!');
    }

    public function edit(Item $item)
    {
        return view('items.edit', ['item' => $item]);
    }

    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
        ]);

        $item->update($validated);

        return redirect()->route('items.index')->with('success', 'Item updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted!');
    }

}
