@vite('resources/css/app.css')
<x-layout>
    <x-slot name="title">
        Create Item
    </x-slot>

    <x-slot name="sidebar">
        The Inventory
        <a href="{{ route('items.create') }}" >CREATE ITEM</a>
    </x-slot>

    <h1>Create Item</h1>

    <form action="{{ route('items.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Item Name:</label>
            <input type="text" name="name" id="name" required value="{{ old('name') }}">
        </div>   

        <div>
            <label for="price">Item Price:</label>
            <input type="number" step="0.01" min="0" name="price" id="price" required value="{{ old('price') }}">
        </div>   

        <button type="submit">Create Item</button>
    </form>

    @if ($errors->any()) 
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
</x-layout>