@props(['title' => 'Users'])

<x-layouts.base :title="$title">
    <x-slot name="sidebar">
        <h3 class="font-semibold text-center">Every Member</h3>

            
        @can('create', \App\Models\User::class)
            <a href="{{ route('users.create') }}" class="btn btn-secondary w-full mt-5">Create User</a>
        @endcan
    </x-slot>

    {{ $slot }}
</x-layouts.base>
