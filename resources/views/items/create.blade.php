<x-layouts.items>
    <x-slot name="title">
        {{__('Create Item')}}
    </x-slot>

    <div class="container my-5">
        <form action="{{ route('items.store') }}" method="POST" class="card shadow-sm p-4 bg-light rounded">
            <h1 class="mb-4 text-2xl font-bold">{{__('Create Item')}}</h1>

            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">{{__('Item Name')}}</label>
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
                <label for="price" class="form-label">{{__('Item Price')}}</label>
                <input 
                    type="number" 
                    step="0.01" 
                    min="0" 
                    name="price" 
                    id="price" 
                    required 
                    value="{{ old('price') }}" 
                    class="form-control @error('price') is-invalid @enderror">
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>   

            <button type="submit" class="btn btn-success">{{__('Create Item ')}}</button>
        </form>

    </div>
</x-layouts.items>
