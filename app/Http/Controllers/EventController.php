<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $user = Auth::user();

        $events = Event::query()
            ->when($request->boolean('managed'), fn($query) =>
                $query->where('user_id', $user->id)
            )
            ->when($request->boolean('with_duties'), fn($query) =>
                $query->whereHas('duties', fn($q) =>
                    $q->where('user_id', $user->id)
                )
            )
            ->when($request->start_date, fn($query) =>
                $query->whereDate('datetime', '>=', $request->start_date)
            )
            ->when($request->end_date, fn($query) =>
                $query->whereDate('datetime', '<=', $request->end_date)
            )
             ->orderBy('datetime', 'asc')
            ->get();

        return view('events.index', ['events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:1000',
            'dresscode' => 'required|string|max:20',
            'datetime' => 'required|date|after:now',
        ]);
    
        $validated['user_id'] = Auth::id();

        // create and save the new event
        Event::create($validated);
    
        return redirect()->route('events.index')->with('success', 'Event created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $event->load(['absences', 'attendances', 'organizer', 'duties.user']);
        $users = User::all();
        return view('events.show', compact('event', 'users'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('events.edit', ['event' => $event]);
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:1000',
            'dresscode' => 'required|string|max:20',
            'datetime' => 'required|date|after:now',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('events', 'public');
            $validated['image_path'] = $path;
        }

        $validated['user_id'] = Auth::id();

        $event->update($validated);

        return redirect()->route('events.index')->with('success', 'Event updated!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully!');
    }
}
