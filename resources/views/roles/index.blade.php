@vite('resources/css/app.css')
<x-layouts.items>
    <x-slot name="title">Manage Roles</x-slot>

    <div class="container w-[100%] mx-auto p-0 my-5">

        

        @if($roles->count() > 0)
        <div class="overflow-x-auto max-w-3xl mx-auto">
            <table class="w-full border border-gray-300 text-sm text-center">
                <thead class="bg-gray-100 text-gray-700 uppercase tracking-wider">
                    <tr>
                        <th class="border px-4 py-2">Role Name</th>
                        <th class="border px-4 py-2">Min Balance</th>
                        @can('create', \App\Models\Item::class)
                            <th class="border px-4 py-2">Actions</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-2">
                            <form method="POST" action="{{ route('roles.update', $role) }}" class="flex items-center gap-2 justify-center">
                                @csrf
                                @method('PUT')
                                <input name="name" value="{{ $role->name }}" class="input input-sm w-40" />
                        </td>
                        <td class="border px-4 py-2">
                                <input name="min_balance" type="number" step="0.01" value="{{ $role->min_balance }}" class="input input-sm w-32" />
                        </td>
                        <td class="border px-4 py-2">
                                <div class="flex gap-2 justify-center">
                                    <button type="submit" class="btn btn-sm btn-outline-success w-[100px] px-4">Save</button>
                            </form>

                            @can('create', \App\Models\User::class)
                            <form method="POST" action="{{ route('roles.destroy', $role) }}">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Delete this role?')" type="submit" class="w-[100px] btn btn-sm btn-outline-danger px-4">Delete</button>
                            </form>
                            @endcan
                                </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="flex justify-center items-center h-40 max-w-3xl mx-auto">
            <h3 class="italic text-gray-600 text-lg">No roles found</h3>
        </div>
        @endif

        {{-- Add Role Form --}}

        <div class="flex justify-center items-center py-4">
            <h3 class="text-md">Add Role</h3>
        </div>
        <form method="POST" action="{{ route('roles.store') }}" class="mb-6 flex gap-3 max-w-3xl mx-auto">
            @csrf
            <input 
                type="text" 
                name="name" 
                placeholder="Role name" 
                class="input input-bordered flex-1" 
                required 
            >
            <input 
                type="number" 
                step="0.01" 
                name="min_balance" 
                placeholder="Min balance" 
                class="input input-bordered w-48" 
                required
            >
            <button class="btn btn-primary px-6" type="submit">+</button>
        </form>

    </div>
</x-layouts.items>
