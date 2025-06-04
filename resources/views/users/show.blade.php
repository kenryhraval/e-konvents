<x-layouts.users>
     <x-slot name="title">
        {{ $user->name }}
    </x-slot>

    <x-slot name="sidebar">
        User List
        <a href="{{ route('users.create') }}">CREATE USER</a>
    </x-slot>
    
    <div class="container mx-auto p-4">

        <h1 class="text-2xl font-bold mb-4">User Details</h1>

        <div class="bg-white shadow-md rounded p-6">
            <p><strong>ID:</strong> {{ $user->id }}</p>
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Phone:</strong> {{ $user->phone ?? 'N/A' }}</p>
            <p><strong>Address:</strong> {{ $user->address ?? 'N/A' }}</p>
            <p><strong>Birthdate:</strong> {{ $user->birthdate ? $user->birthdate->format('Y-m-d') : 'N/A' }}</p>
            <p><strong>Balance:</strong> {{ number_format($user->balance, 2) }} €</p>
            <p><strong>Roles:</strong> 
                @forelse ($user->roles as $role)
                    <span class="inline-block bg-blue-200 text-blue-800 px-2 py-1 rounded-full text-xs">{{ $role->name }}</span>
                @empty
                    No roles assigned
                @endforelse
            </p>

            <div class="mt-6">
                <a href="{{ route('users.edit', $user) }}" class="text-blue-500 hover:underline">Edit User</a>
                <a href="{{ route('users.index') }}" class="text-gray-500 hover:underline ml-4">Back to list</a>
            </div>
        </div>
    </div>
</x-layouts.users>
