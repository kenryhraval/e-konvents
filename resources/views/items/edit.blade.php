<x-layout>
    <h1>Edit Item</h1>

    <form method="POST" action="{{ route('items.update', $item) }}">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Item Name:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $item->name) }}" required>
        </div>

        <div>
            <label for="price">Item Price:</label>
            <input type="number" step="0.01" min="0" name="price" id="price" required value="{{ old('price', $item->price) }}">
        </div>   

        <button type="submit">Update Item</button>
    </form>
</x-layout>
