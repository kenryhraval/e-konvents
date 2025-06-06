<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absence;
use Illuminate\Support\Facades\Auth;

class AbsenceController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'reason' => 'required|string|max:1000',
        ]);

        Absence::create([
            'event_id' => $request->event_id,
            'user_id' => Auth::id(),
            'reason' => $request->reason,
        ]);

        return redirect()->route('events.show', $request->event_id)
                        ->with('success', 'Absence recorded.');
    }

    public function update(Request $request, Absence $absence)
    {
        $request->validate([
            'reason' => 'required|string|max:1000',
        ]);

        $absence->update([
            'reason' => $request->reason,
        ]);

        return redirect()->route('events.show', $absence->event_id)
                        ->with('success', 'Absence updated.');
    }

    public function destroy(Absence $absence)
    {
        $eventId = $absence->event_id;

        $absence->delete();

        return redirect()->route('events.show', $eventId)
            ->with('success', 'Absence deleted successfully.');
    }


}
