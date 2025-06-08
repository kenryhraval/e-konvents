<x-layouts.users>
    <x-slot name="title">
        {{ $user->name }}
    </x-slot>

    <div class="container my-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">{{ $user->name }}</h2>
            </div>

            <div class="card-body">
                <p class="mb-3">
                    <strong>{{__('Email')}}:</strong>
                    {{ $user->email }}
                </p>

                <p class="mb-3">
                    <strong>{{__('Phone')}}:</strong>
                    {{ $user->phone_number ?? 'N/A' }}
                </p>

                <p class="mb-3">
                    <strong>{{__('Address')}}:</strong>
                    {{ $user->address ?? 'N/A' }}
                </p>

                <p class="mb-3">
                    <strong>{{__('Birthdate')}}:</strong>
                    {{ $user->birthdate ? $user->birthdate->format('Y-m-d') : 'N/A' }}
                </p>

                <p class="mb-3">
                    <strong>{{__('Balance')}}:</strong>
                    {{ number_format($user->balance, 2) }} €
                </p>

                <p class="mb-3">
                    <strong>{{__('Points')}}:</strong>
                    {{ $user->points }}
                </p>

                <p>
                    <strong>{{__('Position')}}:</strong>
                    @forelse ($user->positions as $position)
                        <span class="me-1">{{ $position->type }}</span>
                    @empty
                        <span class="text-muted">{{__('No positions assigned')}}</span>
                    @endforelse
                </p>
            </div>

            <div class="card-footer d-flex justify-content-between align-items-center">
                <a href="{{ route('users.index') }}" class="btn btn-secondary">
                    ← {{__('All Users')}}
                </a>

                <div class="d-flex gap-2">
                @can('update', $user, \App\Models\User::class)
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-primary">
                        {{__('Edit User')}}
                    </a>
                @endcan
                
                @can('delete', \App\Models\User::class)
                    <form method="POST" action="{{ route('users.destroy', $user) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">
                            {{__('Delete')}}
                        </button>
                    </form>
                @endcan
                </div>
                
            </div>
        </div>
    </div>
</x-layouts.users>
