@vite('resources/css/app.css')
<x-layout>
    <h1>Create Event</h1>

    <form action="{{ route('events.store') }}" method="POST">
        @csrf {{-- VERY important for security --}}

        <div>
            <label for="name">Event Name:</label>
            <input type="text" name="name" id="name" required>
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description" required></textarea>
        </div>

        <div>
            <label for="dresscode">Dresscode:</label>
            <input type="text" name="dresscode" id="dresscode">
        </div>

        <div>
            <label for="datetime">Datetime:</label>
            <input type="datetime-local" name="datetime" id="datetime">
        </div>
        

        <button type="submit">Create Event</button>
    </form>
</x-layout>