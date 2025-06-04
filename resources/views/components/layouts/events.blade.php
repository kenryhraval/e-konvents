@props(['title' => 'Events'])

<x-layouts.base :title="$title">
    <x-slot name="sidebar">
        <h3 class="font-semibold text-center">Events Listed</h3>


        @can('create', \App\Models\Event::class)
            <a href="{{ route('events.create') }}" class="btn btn-secondary w-full mt-5">Create Event</a>
            <a href="{{ route('items.create') }}" class="btn btn-secondary w-full mt-2">Managed Events</a>
            <a href="{{ route('items.create') }}" class="btn btn-secondary w-full mt-2">New Login Code</a>
        @endcan
    </x-slot>

    {{ $slot }}
</x-layouts.base>
