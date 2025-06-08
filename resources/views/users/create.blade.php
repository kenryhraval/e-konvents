<x-layouts.users>
    <x-slot name="title">
        {{__('Create User')}}
    </x-slot>

    <div class="container my-5">
        <form method="POST" action="{{ route('users.store') }}" class="card shadow-sm p-4 bg-light rounded">
            <h1 class="mb-4 text-2xl font-bold">{{__('Register User')}}</h1>

            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">{{__('Name')}}</label>
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
                <label for="email" class="form-label">{{__('Email')}}</label>
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
                <label for="birthdate" class="form-label">{{__('Birthdate')}}</label>
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

            <button type="submit" class="btn btn-success">{{__('Register')}}</button>
        </form>

    </div>
</x-layouts.users>
