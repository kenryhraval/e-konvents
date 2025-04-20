@vite('resources/css/app.css')
<x-layout>
    <h1>Create Event</h1>

    <form action="{{ route('events.store') }}" method="POST">
        @csrf {{-- VERY important for security --}}

        <div>
            <label for="name">Event Name:</label>
            {{-- old is needed for cases of errors --}}
            <input type="text" name="name" id="name" required value="{{ old('name') }}">
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description" required>{{ old('description') }}</textarea>
        </div>
        

        @php
            $dresscodes = ['Full suit', 'Semi-formal', 'Casual', 'Traditional', 'Theme costume'];
        @endphp

        <div>
            <label for="dresscode">Dresscode:</label>
            <select name="dresscode" id="dresscode" required>
                <option value="" disabled selected>Select a dresscode</option>
                @foreach ($dresscodes as $dresscode)
                    <option value="{{ $dresscode }}" {{ old('dresscode') == $dresscode ? 'selected' : '' }}>
                        {{ $dresscode }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="datetime">Datetime:</label>
            <input type="datetime-local" name="datetime" id="datetime" required value="{{ old('datetime') }}">
        </div>
        

        <button type="submit">Create Event</button>
    </form>

    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</x-layout>