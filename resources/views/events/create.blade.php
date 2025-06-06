<x-layouts.events>
    <x-slot name="title">
        Create Event
    </x-slot>

    <div class="container my-5">
        <form action="{{ route('events.store') }}" method="POST" class="card shadow-sm p-4 bg-light rounded">
            <h1 class="mb-4 text-2xl font-bold">Create Event</h1>

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
                    class="form-control h-32 resize-none @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
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

            <button type="submit" class="btn btn-success">Create Event</button>
        </form>

        @if ($errors->any())
            <div class="alert alert-danger mt-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</x-layouts.events>
