@props(['title' => 'Events'])

<x-layouts.base :title="$title">
    <x-slot name="sidebar">
        <h3 class="font-semibold text-center pb-0 mb-0">Events Listed</h3>


        @can('create', \App\Models\Event::class)
        <div class="!px-6 pb-2">
            <a href="{{ route('items.create') }}" class="btn btn-secondary w-full mt-5">Managed Events</a>
            <a href="{{ route('items.create') }}" class="btn btn-secondary w-full mt-2">New Login Code</a>
            

            <!-- Create Button -->
            <div id="createBtnWrapper">
                <button 
                    onclick="toggleForm(true)" 
                    class="btn btn-secondary w-full mt-2">
                    Create Event
                </button>
            </div>
        </div>

            <!-- Form -->
            <div 
                id="createForm" 
                class="hidden my-4 bg-white border border-gray-300 w-full"
            >
                <div class="flex justify-between items-center bg-gray-100 px-4 py-2 border-b border-gray-300">
                    <span class="text-sm font-semibold text-gray-700">Create Event</span>
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
                    action="{{ route('items.store') }}" 
                    class="p-4"
                >
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Event Name</label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            required 
                            value="{{ old('name') }}" 
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea 
                            name="description" 
                            id="description" 
                            required 
                            class="form-control h-16 resize-none @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    @php
                        $dresscodes = ['Full suit', 'Semi-formal', 'Casual', 'Traditional', 'Theme costume'];
                    @endphp

                    <div class="mb-3">
                        <label for="dresscode" class="form-label">Dresscode</label>
                        <select 
                            name="dresscode" 
                            id="dresscode" 
                            required 
                            class="form-select @error('dresscode') is-invalid @enderror">
                            <option value="" disabled selected>Select a dresscode</option>
                            @foreach ($dresscodes as $dresscode)
                                <option value="{{ $dresscode }}" {{ old('dresscode') == $dresscode ? 'selected' : '' }}>
                                    {{ $dresscode }}
                                </option>
                            @endforeach
                        </select>
                        @error('dresscode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="datetime" class="form-label">Event Date & Time</label>
                        <input 
                            type="datetime-local" 
                            name="datetime" 
                            id="datetime" 
                            required 
                            value="{{ old('datetime') }}" 
                            class="form-control @error('datetime') is-invalid @enderror">
                        @error('datetime')
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
