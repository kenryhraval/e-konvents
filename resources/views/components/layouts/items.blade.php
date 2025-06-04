@props(['title' => 'Items'])

<x-layouts.base :title="$title">
    <x-slot name="sidebar">
        <h3 class="font-semibold text-center">The Inventory</h3>

        <form method="GET" action="{{ route('items.index') }}" id="filterForm" class="flex flex-col gap-2">
            <input 
                type="text" 
                name="search" 
                placeholder="Search items..." 
                value="{{ request('search') }}" 
                class="border px-2 py-1 w-full"
            />

            <button type="submit" class="btn btn-primary w-full">Search</button>

            <input type="checkbox" 
                class="btn-check" 
                value="1" 
                name="sorted" 
                id="sortCheckbox" 
                {{ request()->boolean('sorted') ? 'checked' : '' }}
            />
            <label class="btn btn-outline-primary w-full" for="sortCheckbox">Sort by price</label>
        </form>

        @can('create', \App\Models\Item::class)
            <a href="{{ route('items.create') }}" class="btn btn-secondary w-full mt-5">Create Item</a>
            <a href="{{ route('items.create') }}" class="btn btn-secondary w-full mt-2">Taken Items</a>
            <a href="{{ route('items.create') }}" class="btn btn-secondary w-full mt-2">Restrict User</a>
        @endcan
    </x-slot>

    {{ $slot }}
</x-layouts.base>
