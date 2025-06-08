@vite('resources/css/app.css')
<x-layouts.users>
    <x-slot name="title">
        {{__('Users')}}
    </x-slot>

    <div class="container w-[100%] mx-auto p-0 my-5">

        @if($users->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-[100%] border border-gray-300 text-sm text-center">
                <thead class="bg-gray-100 text-gray-700 uppercase tracking-wider">
                    <tr>
                        <th class="border px-4 py-2">{{__('Name')}}</th>
                        <th class="border px-4 py-2">{{__('Admin Roles')}}</th>
                        <th class="border px-4 py-2">{{__('Positions')}}</th>
                        <th class="border px-4 py-2">{{__('Balance')}}</th>
                        
                        @can('delete', \App\Models\User::class)
                        <th class="border px-4 py-2">{{__('Actions')}}</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50">

                            
                            <td class="border px-4 py-2">
                                <a href="{{ route('users.show', $user->id) }}" class="text-decoration-underline">
                                    {{ $user->name }}
                                </a>
                            </td>

                            <td class="border px-4 py-2 space-x-1">
                                @forelse ($user->admins as $admin)
                                    <span class="inline-block bg-blue-200 text-blue-800 px-2 py-1 rounded-full text-xs">
                                        {{ $admin->type }}
                                    </span>
                                @empty
                                    <span class="text-gray-400 italic">
                                        {{__('none')}}
                                    </span>
                                @endforelse
                            </td>
                            <td class="border px-4 py-2 space-x-1">
                                @forelse ($user->positions as $position)
                                    <span class="inline-block bg-green-200 text-green-800 px-2 py-1 my-1 rounded-full text-xs">{{ $position->roleType->name }}</span>
                                @empty
                                    <span class="text-gray-400 italic">
                                        {{__('none')}}
                                    </span>
                                @endforelse
                            </td>
                            <td class="border px-4 py-2">{{ number_format($user->balance, 2) }} €</td>
                            
                            @can('delete', \App\Models\User::class)
                            <td class="border px-2 py-2">
                                <div class="flex flex-col lg:flex-row gap-2 w-full h-full">
                                    
                                    <a href="{{ route('users.edit', $user) }}"
                                    class="flex-1 text-center py-1  bg-gray-100 hover:bg-gray-300 border rounded">
                                        {{__('Edit')}}
                                    </a>

                                    <form action="{{ route('users.destroy', $user) }}"
                                        method="POST"
                                        class="flex-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full h-full text-center py-1 px-2 bg-gray-100 hover:bg-gray-300 text-red-500 border rounded">
                                            {{__('Delete')}}
                                        </button>
                                    </form>
                                </div>
                            </td>
                            @endcan

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @else
        <div class="flex justify-center items-center h-40">
            <h3 class="italic text-gray-600 text-lg">{{__('No records meet the criteria')}}</h3>
        </div>
        @endif
    </div>
</x-layouts.users>
