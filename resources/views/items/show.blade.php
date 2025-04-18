<x-layout>
    <h1>{{ $item->name }}</h1>

    <p><strong>Price:</strong> {{ $item->price }}</p>

    <a href="{{ route('items.edit', $item) }}" class="edit-button">
        Edit
    </a>

    <form method="POST" action="{{ route('items.destroy', $item) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="delete-button">
            Delete
        </button>
    </form>

    <a href="{{ route('items.index') }}">Back to Items</a>


</x-layout>
