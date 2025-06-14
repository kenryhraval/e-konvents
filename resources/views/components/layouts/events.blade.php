    @props(['title' => 'Events'])

    <x-layouts.base :title="$title">
        <x-slot name="sidebar">

            <div class="!px-6">
            <h3 class="font-semibold text-center pb-4">{{__('Events Listed')}}</h3>

            <div id="calendar" class="p-0"></div>     

            <form method="GET" action="{{ route('events.index') }}" id="filterForm" class="flex flex-col gap-2">
                <input type="hidden" id="selected_dates" name="selected_dates" value="">

                <button type="submit" class="mt-2 retro-button">{{__('Filter Interval')}}</button>

                <input 
                    type="checkbox" 
                    class="btn-check" 
                    value="1" 
                    name="managed" 
                    id="managedCheckbox" 
                    {{ request()->boolean('managed') ? 'checked' : '' }}
                />
                <label class="btn btn-outline-primary w-full" for="managedCheckbox">{{__('Managed by me')}}</label>

                <input 
                    type="checkbox" 
                    class="btn-check" 
                    value="1" 
                    name="with_duties" 
                    id="dutiesCheckbox" 
                    {{ request()->boolean('with_duties') ? 'checked' : '' }}
                />
                <label class="btn btn-outline-primary w-full" for="dutiesCheckbox">{{__('With my duties')}}</label>

                
            </form>

            @can('create', \App\Models\Event::class)            

                <!-- Create Button -->
                <div id="createBtnWrapper" class="mt-4">
                    <button 
                        onclick="toggleForm(true)" 
                        class="btn btn-secondary w-full mt-2 ">
                        {{__('Create Event')}}
                    </button>
                </div>
            </div>

                <!-- Form -->
                <div 
                    id="createForm" 
                    class="hidden my-5 bg-white border border-gray-300 w-full"
                >
                    <div class="flex justify-between items-center bg-gray-100 px-4 py-2 border-b border-gray-300">
                        <span class="text-sm font-semibold text-gray-700">{{__('Create Event')}}</span>
                        <button 
                            onclick="toggleForm(false)" 
                            class="text-gray-500 hover:text-red-500 text-2xl leading-none font-bold"
                            aria-label="Close Create User Form"
                        >
                            &times;
                        </button>
                    </div>

                    <form 
                        method="POST" 
                        action="{{ route('events.store') }}" 
                        class="p-4"
                    >
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">{{__('Event Name')}}</label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                required 
                                value="{{ old('name') }}" 
                                class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">{{__('Description')}}</label>
                            <textarea  
                                name="description" 
                                id="description" 
                                required 
                                class="form-control h-8 resize-none @error('description') is-invalid @enderror">
                                {{ old('description') }}
                            </textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @php
                            $dresscodes = ['Full suit', 'Semi-formal', 'Casual', 'Traditional', 'Theme costume'];
                        @endphp

                        <div class="mb-3">
                            <label for="dresscode" class="form-label">{{__('Dresscode')}}</label>
                            <select 
                                name="dresscode" 
                                id="dresscode" 
                                required 
                                class="form-select @error('dresscode') is-invalid @enderror">
                                <option value="" disabled selected>{{__('Select a dresscode')}}</option>
                                @foreach ($dresscodes as $dresscode)
                                    <option value="{{ $dresscode }}" {{ old('dresscode') == $dresscode ? 'selected' : '' }}>
                                        {{ $dresscode }}
                                    </option>
                                @endforeach
                            </select>
                            @error('dresscode')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="datetime" class="form-label">{{__('Event Date & Time')}}</label>
                            <input 
                                type="datetime-local" 
                                name="datetime" 
                                id="datetime" 
                                required 
                                value="{{ old('datetime') }}" 
                                class="form-control @error('datetime') is-invalid @enderror">
                            @error('datetime')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success w-full">{{__('Register')}}</button>
                        </div>
                    </form>
                </div>
            @endcan
        </x-slot>
        <main class="main">
        {{ $slot }}
        </main>
    </x-layouts.base>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    const selectedDatesInput = document.getElementById('selected_dates');
    let selectedDates = [];

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 'auto',
        headerToolbar: {
            left: 'prev,next',
            center: 'title',
            right: ''
        },

        dateClick: function(info) {
            const clickedDate = info.dateStr;

            const index = selectedDates.indexOf(clickedDate);
            if (index > -1) {
                // date already selected - deselect
                selectedDates.splice(index, 1);
            } else {
                // add new selected date
                selectedDates.push(clickedDate);
            }

            // Update the hidden input with comma-separated dates
            selectedDatesInput.value = selectedDates.join(',');

            // Re-render events to highlight selected dates
            calendar.refetchEvents();
        },

        events: function(fetchInfo, successCallback, failureCallback) {
            // Return the selected dates as 'events' to highlight them
            const events = selectedDates.map(date => ({
                title: '',
                start: date,
                allDay: true,
                display: 'background',
                backgroundColor: '#87CEFA'
            }));
            successCallback(events);
        }
    });

    calendar.render();
});
</script>