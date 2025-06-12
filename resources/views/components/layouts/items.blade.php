@props(['title' => 'Items'])

<x-layouts.base :title="$title">
    <x-slot name="sidebar">

        <div class="!px-6">

            <h3 class="font-semibold text-center pb-4"> {{__('The Inventory')}}</h3>

            <form method="GET" action="{{ route('items.index') }}" id="filterForm" class="flex flex-col gap-2">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="{{__('Search items...')}}" 
                    value="{{ request('search') }}" 
                    class="border px-2 py-1 w-full"
                />

                <button type="submit" class="retro-button"> {{__('Search')}}</button>

                <input type="checkbox" 
                    class="btn-check" 
                    value="1" 
                    name="sorted" 
                    id="sortCheckbox" 
                    {{ request()->boolean('sorted') ? 'checked' : '' }}
                />
                <label class="btn btn-outline-primary w-full" for="sortCheckbox"> {{__('Sort by price')}}</label>
            </form>
        </div>

        @can('create', \App\Models\Item::class)
        <div class="!px-6 py-4">
            <a href="{{ route('taken.index') }}" class="btn btn-secondary w-full mt-2"> {{__('Taken Items')}}</a>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary w-full mt-2"> {{__('Restrictions')}}</a>

            <!-- Create Button -->
            <div id="createBtnWrapper" class="">
                <button 
                    onclick="toggleForm(true)" 
                    class="btn btn-secondary w-full mt-2">
                     {{__('Create Item')}}
                </button>
            </div>
        </div>
            <!-- Form -->
            <div 
                id="createForm" 
                class="hidden mt-4 bg-white border border-gray-300 w-full"
            >
                <div class="flex justify-between items-center bg-gray-100 px-4 py-2 border-b border-gray-300">
                    <span class="text-sm font-semibold text-gray-700">{{__('Create Item')}}</span>
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
                        <label for="name" class="form-label"> {{__('Item Name')}}</label>
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
                        <label for="price" class="form-label"> {{__('Item Price')}}</label>
                        <input 
                            type="number" 
                            name="price" 
                            id="price" 
                            required 
                            value="{{ old('price') }}" 
                            class="form-control @error('price') is-invalid @enderror">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>   

                    <div class="text-end">
                        <button type="submit" class="btn btn-success w-full"> {{__('Register')}}</button>
                    </div>
                </form>
            </div>

        @endcan
           
    </x-slot>

    <main class="main">
        {{ $slot }}
    </main>
</x-layouts.base>
