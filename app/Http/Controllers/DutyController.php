<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Duty;
use App\Models\Event;

class DutyController extends Controller
{
    public function store(Request $request, Event $event)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'type' => ['required', 'string', 'max:255'],
        ]);

        Duty::create([
            'user_id' => $validated['user_id'],
            'details' => $validated['type'],
            'event_id' => $event->id,
        ]);

        return redirect()->route('events.show', $event)
                        ->with('success', __('Duty assigned successfully'));
    }

    public function destroy(Duty $duty)
    {
        $event = $duty->event;
        $duty->delete();

        return redirect()->route('events.show', $event)
                        ->with('success', __('Duty removed'));
    }

}
