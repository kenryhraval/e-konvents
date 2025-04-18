<x-layout>
    <h1>Edit Event</h1>

    <form method="POST" action="{{ route('events.update', $event) }}">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $event->name) }}" required>
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description" required>{{ old('description', $event->description) }}</textarea>
        </div>

        <div>
            <label for="dresscode">Dresscode:</label>
            <input type="text" name="dresscode" id="dresscode" value="{{ old('dresscode', $event->dresscode) }}" required>
        </div>

        <div>
            <label for="datetime">Datetime:</label>
            <input type="datetime-local" name="datetime" id="datetime" value="{{ old('datetime', $event->datetime->format('Y-m-d\TH:i')) }}" required>
        </div>

        <button type="submit">Update Event</button>
    </form>
</x-layout>
