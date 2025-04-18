<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();
        return view('items.index', ['items' => $items]);
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

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        // $item->load(...)
        return view('items.show', ['item' => $item]);
    }

    /**
     * Show the form for editing the specified resource.
     */
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

        return redirect()->route('items.index')->with('success', 'Item deleted successfully!');
    }
}
