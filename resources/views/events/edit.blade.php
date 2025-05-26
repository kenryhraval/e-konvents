<x-layout>
    <x-slot name="title">
        Edit
    </x-slot>
    
    <x-slot name="sidebar">
        Events Display
    </x-slot>

    <div class="form-1">
        <form method="POST" action="{{ route('events.update', $event) }}" class="form-2 ">
            
            <h1 class="text-3xl font-bold uppercase text-center mb-12">Edit Event</h1>
            
            @csrf
            @method('PUT')

            <div class="form-field">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="{{ old('name', $event->name) }}" required>
            </div>

            <div class="form-field">
                <label for="description">Description:</label>
                <textarea name="description" id="description" required class="h-32 resize-none">{{ old('description', $event->description) }}</textarea>
            </div>

            <div class="form-field">
                <label for="dresscode">Dresscode:</label>
                <select name="dresscode" id="dresscode" required>
                    <option value="" disabled>Select a dresscode</option>
                    @foreach (['Full suit', 'Semi-formal', 'Casual', 'Traditional', 'Theme costume'] as $dresscode)
                        <option value="{{ $dresscode }}" {{ old('dresscode', $event->dresscode) == $dresscode ? 'selected' : '' }}>
                            {{ $dresscode }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-field">
                <label for="datetime">Datetime:</label>
                <input type="datetime-local" name="datetime" id="datetime" value="{{ old('datetime', $event->datetime->format('Y-m-d\TH:i')) }}" required>
            </div>

            <div class="w-full flex justify-center">
                <button type="submit" class="btn w-full md:w-auto">Update Event</button>
            </div>
        </form>
    </div>

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
