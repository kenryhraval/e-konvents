<x-layout>
    <h1>{{ $event->name }}</h1>

    <p><strong>Description:</strong> {{ $event->description }}</p>

    <p><strong>Dresscode:</strong> {{ $event->dresscode }}</p>

    <p><strong>Date and Time:</strong> {{ $event->datetime->format('d.m.Y H:i') }}</p>

    <a href="{{ route('events.edit', $event) }}" class="edit-button">
        Edit
    </a>

    <form method="POST" action="{{ route('events.destroy', $event) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="delete-button">
            Delete
        </button>
    </form>
    


    <a href="{{ route('events.index') }}">Back to Events</a>


</x-layout>
