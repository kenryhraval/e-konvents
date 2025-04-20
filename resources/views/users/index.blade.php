@vite('resources/css/app.css')
<x-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Users</h1>

        <table class="w-full border-collapse border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">ID</th>
                    <th class="border p-2">Name</th>
                    <th class="border p-2">Email</th>
                    {{-- <th class="border p-2">Roles</th> --}}
                    <th class="border p-2">Balance</th>
                    <th class="border p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="text-center">
                        <td class="border p-2">{{ $user->id }}</td>
                        <td class="border p-2">{{ $user->name }}</td>
                        <td class="border p-2">{{ $user->email }}</td>
                        {{-- <td class="border p-2">
                            @foreach ($user->roles as $role)
                                <span class="inline-block bg-blue-200 text-blue-800 px-2 py-1 rounded-full text-xs">{{ $role->name }}</span>
                            @endforeach
                        </td> --}}
                        <td class="border p-2">{{ number_format($user->balance, 2) }} €</td>
                        <td class="border p-2">
                            <a href="{{ route('users.edit', $user) }}" class="text-blue-500 hover:underline">Edit</a>
                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        
    </div>
</x-layout>

