@vite('resources/css/app.css')
<x-layout>
     <x-slot name="title">
        Items
    </x-slot>

    <x-slot name="sidebar">
    <div class="mb-4">
        <h3 class="font-semibold mb-2">The Inventory</h3>
        <a href="{{ route('items.create') }}" class="text-blue-600 underline mb-4 inline-block">CREATE ITEM</a>
        
        <!-- Search form -->
        <form method="GET" action="{{ route('items.index') }}" id="filterForm" class="space-y-2">
            <input 
                type="text" 
                name="search" 
                placeholder="Search items..." 
                value="{{ request('search') }}" 
                class="border px-2 py-1 w-full"
                oninput="document.getElementById('filterForm').submit()"
            />
            
            <label class="inline-flex items-center gap-1">
                <input 
                    type="checkbox" 
                    name="sortByCost" 
                    value="1" 
                    {{ request()->boolean('sortByCost') ? 'checked' : '' }} 
                    onchange="document.getElementById('filterForm').submit()"
                />
                <span>Sort by price</span>
            </label>
        </form>
    </div>
</x-slot>

    <div id="accordion" data-accordion="collapse" class="border divide-y max-w-[700px] mx-auto"
     data-active-classes="bg-gray-200 font-semibold"
     data-inactive-classes="bg-white font-normal">
    @foreach ($items as $item)
        <div>
            <h2 id="heading-{{ $item->id }}" class="m-0 p-0">
                <button
                    type="button"
                    data-accordion-target="#body-{{ $item->id }}"
                    aria-expanded="false"
                    aria-controls="body-{{ $item->id }}"
                    class="w-full text-left text-black px-3 py-2"
                >
                    {{ \Illuminate\Support\Str::limit($item->name, 36, '...') }}

                </button>   
            </h2>

            <div id="body-{{ $item->id }}" class="hidden border-t px-3 py-2" aria-labelledby="heading-{{ $item->id }}">
                <p class="text-base text-gray-600 mb-2">Price: <strong>{{ $item->price }} €</strong></p>

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                    
                    {{-- Take Form --}}
                    <form method="POST" action="{{ route('taken.store', $item->id) }}" class="flex flex-1 flex-col md:flex-row gap-2">
                        @csrf
                        <input type="text" name="reason" placeholder="Reason" class="border px-2 py-1 w-full md:w-1/2" />
                        <div class="flex items-center gap-2 w-full md:w-auto justify-end">
                            <input type="number" name="count" min="1" max="{{ $item->stock }}" value="1" class="border px-2 py-1 w-20" />
                            <button type="submit" class="px-3 py-1 border">Take</button>
                        </div>
                    </form>

                    @can('update', $item)
                        {{-- Edit Button --}}
                        <a href="{{ route('items.edit', $item->id) }}" class="px-3 py-1 border">Edit</a>

                        {{-- Delete Form --}}
                        <form method="POST" action="{{ route('items.destroy', $item) }}">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-1 border">Delete</button>
                        </form>
                    @endcan
                    

                </div>
            </div>


        </div>
    @endforeach
</div>


    <div>
        {{ $items->links() }}
    </div>




    
</x-layout>
