<x-layouts.events>
    <x-slot name="title">
        Events Display
    </x-slot>

    <div class="container my-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">{{ $event->name }}</h2>
            </div>

            <div class="card-body">
                <p class="mb-3">
                    <strong>Description:</strong><br>
                    {{ $event->description }}
                </p>

                <p><strong>Dresscode:</strong> {{ $event->dresscode }}</p>

                <p><strong>Date and Time:</strong> {{ $event->datetime->format('d.m.Y H:i') }}</p>

                <p>
                    <strong>Organizer:</strong>
                    <a href="{{ route('users.show', $event->user_id) }}" class="text-decoration-underline">
                        {{ $event->organizer->name ?? 'Unknown' }}
                    </a>
                </p>

                {{-- Duties List --}}
                @if ($event->duties->isNotEmpty())
                    <div class="mt-4">
                        <h5 class="mb-2">Assigned Duties</h5>
                        <table class="table table-bordered w-100" style="table-layout: fixed;">
                            <thead>
                                <tr>
                                    <th>Member</th>
                                    <th>Duty</th>
                                    @can('update', $event)
                                        <th class="w-[20%]">Delete</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($event->duties as $duty)
                                    <tr>
                                        <td>
                                            <a href="{{ route('users.show', $duty->user_id) }}">
                                                {{ $duty->user->name ?? 'Unknown' }}
                                            </a>
                                        </td>
                                        <td>{{ $duty->details }}</td>
                                        @can('update', $event)
                                        <td>
                                            <form action="{{ route('duties.destroy', $duty->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Remove Duty">&times;</button>
                                            </form>
                                        </td>
                                        @endcan
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                @else
                    <p><strong>No assigned duties...</strong></p>
                @endif


            </div>

            <div class="card-footer d-flex justify-content-between align-items-center">
                <a href="{{ route('events.index') }}" class="btn btn-secondary">
                    ← Back
                </a>
                
                <div class="d-flex gap-2">
                    @cannot('update', $event)
                        @php
                            $userAbsence = $event->absences->firstWhere('user_id', auth()->id());
                        @endphp

                        <button class="btn btn-outline-warning"
                                onclick="document.getElementById('absence-form').classList.toggle('d-none')">
                            {{ $userAbsence ? 'Edit Absence' : 'Mark Absence' }}
                        </button>
                    @endcannot

                    <button class="btn btn-outline-info" onclick="document.getElementById('attendees-list').scrollIntoView({ behavior: 'smooth' });">
                        Attendees
                    </button>

                    @can('update', $event)
                        <button class="btn btn-outline-warning" onclick="document.getElementById('absences-list').scrollIntoView({ behavior: 'smooth' });">
                            Absences
                        </button>

                        <a href="{{ route('events.edit', $event) }}" class="btn btn-outline-primary">
                            Edit
                        </a>

                        <form method="POST" action="{{ route('events.destroy', $event) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">
                                Delete
                            </button>
                        </form>
                    @endcan
                    
                </div>
                
            </div>
        </div>

        @cannot('update', $event)
            @php
                $userAbsence = $event->absences->firstWhere('user_id', auth()->id());
            @endphp

            <div id="absence-form" class="card mt-4 shadow-sm {{ $userAbsence ? '' : 'd-none' }}">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">{{ $userAbsence ? 'Edit Absence' : 'Submit Absence' }}</h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ $userAbsence ? route('absences.update', $userAbsence) : route('absences.store') }}">
                        @csrf
                        @if($userAbsence)
                            @method('PUT')
                        @endif

                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        <textarea name="reason" class="form-control mb-3" rows="3" placeholder="Reason for absence..." required>{{ old('reason', $userAbsence->reason ?? '') }}</textarea>

                        <button type="submit" class="btn btn-outline-warning  w-100">
                            {{ $userAbsence ? 'Update Absence' : 'Submit Absence' }}
                        </button>
                    </form>

                    @if($userAbsence)
                        <form action="{{ route('absences.destroy', $userAbsence) }}" method="POST" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger w-100">
                                Delete Absence
                            </button>
                        </form>
                    @endif

                </div>
            </div>
        @endcannot

        @can('update', $event)
            <div class="card shadow-sm mt-5">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Assign a Duty</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('duties.store', $event->id) }}" method="POST" class="d-flex flex-column gap-3">
                        @csrf
                        <input type="hidden" name="event_id" value="{{ $event->id }}">

                        <div>
                            <label for="user_id" class="form-label">User</label>
                            <select name="user_id" id="user_id" class="form-select" required>
                                <option value="">Select user</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="type" class="form-label">Duty Type</label>
                            <input type="text" name="type" id="type" class="form-control" placeholder="e.g. Photographer" required>
                        </div>

                        <button type="submit" class="btn btn-outline-success w-100">Assign Duty</button>
                    </form>
                </div>
            </div>

            <div id="absences-list" class="card shadow-sm mt-5">
                <div class="card-header bg-warning">
                    <h5 class="mb-0">Absences</h5>
                </div>

                <div class="card-body">
                    @if($event->absences->isNotEmpty())
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Reason</th>
                                    <th>Submitted</th>
                                    <th class="w-[20%]">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($event->absences as $absence)
                                    <tr>
                                        <td>
                                            <a href="{{ route('users.show', $absence->user_id) }}">
                                                {{ $absence->user->name }}
                                            </a>
                                        </td>
                                        <td>{{ $absence->reason }}</td>
                                        <td>{{ $absence->created_at->format('d.m.Y H:i') }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('absences.destroy', $absence) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Absence">
                                                    &times;
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    
                    @else
                        <p class="mb-0 text-muted">No absences have been submitted.</p>
                    @endif
                </div>
            </div>
        @endcan

        <div id="attendees-list" class="card mt-5 shadow-sm">
            <div class="card-header bg-info d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Expected Attendees</h5>

                @can('update', $event)
                    <form action="{{ route('attendances.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        
                @endcan
            </div>

            <div class="card-body">
                <ul class="list-group">
                    @php
                        $expected = $users->whereNotIn('id', $event->absences->pluck('user_id'));
                        $attended = $event->attendances->pluck('user_id')->toArray();
                    @endphp

                    @foreach ($expected as $user)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a>

                            @can('update', $event)
                                <div class="form-check">
                                    <input class="form-check-input p-2" type="checkbox" name="attendees[]" value="{{ $user->id }}"
                                        id="attendee-{{ $user->id }}"
                                        {{ in_array($user->id, $attended) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="attendee-{{ $user->id }}">
                                        Present
                                    </label>
                                </div>
                            @else
                                <span class="badge {{ in_array($user->id, $attended) ? 'bg-success' : 'bg-secondary' }}">
                                    {{ in_array($user->id, $attended) ? 'Present' : 'Not marked' }}
                                </span>
                            @endcan
                        </li>
                    @endforeach
                </ul>
            

            @can('update', $event)
            <button type="submit" class="btn btn-outline-info w-100 mt-3">Save Attendance</button>
            </form>
            @endcan
            </div>
        </div>

        
    </div>
</x-layouts.events>
