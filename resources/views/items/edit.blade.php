<x-layouts.items>
    <x-slot name="title">
        {{__('Edit Item')}}
    </x-slot>

    <div class="container my-5">
        <form method="POST" action="{{ route('items.update', $item) }}" class="card shadow-sm p-4 bg-light rounded">
            <h1 class="mb-4">{{__('Edit Item')}}</h1>
            
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">{{__('Item Name')}}</label>
                <input type="text" name="name" id="name"
                value="{{ old('name', $item->name) }}"
                required
                class="form-control @error('name') is-invalid @enderror">

                <div class="invalid-feedback">
                    @error('name')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            

            <div class="mb-3">
                <label for="price" class="form-label">{{__('Item Price')}}</label>
                <input type="number" 
                step="0.01" min="0" 
                name="price" id="price" 
                required value="{{ old('price', $item->price) }}"  
                class="form-control @error('name') is-invalid @enderror">

                <div class="invalid-feedback">
                    @error('price')
                        {{ $message }}
                    @enderror
                </div>
            </div>   

            <button type="submit" class="btn btn-success">{{__('Update Item')}}</button>
        </form>
    </div>
</x-layouts.items>
