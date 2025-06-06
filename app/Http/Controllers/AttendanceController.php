<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Attendance;
use \App\Models\Event;

class AttendanceController extends Controller
{
    public function store(Request $request)
    {
        $event = Event::findOrFail($request->input('event_id'));

        // Remove old attendance records for this event
        Attendance::where('event_id', $event->id)->delete();

        // Store new ones
        $attendees = $request->input('attendees', []);
        foreach ($attendees as $userId) {
            Attendance::create([
                'event_id' => $event->id,
                'user_id' => $userId,
            ]);
        }

        return redirect()->route('events.show', $event)->with('success', 'Attendance updated.');
    }


}
