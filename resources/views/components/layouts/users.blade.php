@props(['title' => 'Users'])

<x-layouts.base :title="$title">
    <x-slot name="sidebar">
        <div class="p-8 pb-1">
            <h3 class="font-semibold text-center">Every Member</h3>
        </div>

        @can('create', \App\Models\User::class)
            <!-- Create Button -->
            <div class="p-4" id="createBtnWrapper">
                <button 
                    onclick="toggleForm(true)" 
                    class="btn btn-secondary w-full mt-1">
                    Create User
                </button>
            </div>

            <!-- Form -->
            <div 
                id="createForm" 
                class="hidden my-4 bg-white border border-gray-300 w-full"
            >
                <div class="flex justify-between items-center bg-gray-100 px-4 py-2 border-b border-gray-300">
                    <span class="text-sm font-semibold text-gray-700">Create User</span>
                    <button 
                        onclick="toggleForm(false)" 
                        class="text-gray-500 hover:text-red-500 text-2xl leading-none font-bold"
                        aria-label="Close Create User Form"
                    >
                        &times;
                    </button>
                </div>

                <form 
                    method="POST" 
                    action="{{ route('users.store') }}" 
                    class="p-4"
                >
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            required 
                            value="{{ old('name') }}" 
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            required 
                            value="{{ old('email') }}" 
                            class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="birthdate" class="form-label">Birthdate</label>
                        <input 
                            type="date" 
                            id="birthdate" 
                            name="birthdate" 
                            value="{{ old('birthdate') }}" 
                            class="form-control @error('birthdate') is-invalid @enderror">
                        @error('birthdate')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success w-full">Register</button>
                    </div>
                </form>
            </div>

        @endcan
    </x-slot>

    {{ $slot }}
</x-layouts.base>
