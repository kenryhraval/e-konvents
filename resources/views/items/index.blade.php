@vite('resources/css/app.css')
<x-layouts.items>

    <div id="accordion" data-accordion="collapse" class="border divide-y mx-auto"
     data-active-classes="bg-gray-800 text-white"
     data-inactive-classes="">
    @foreach ($items as $item)
    
    @php
        $isFirst = $loop->first;
    @endphp
        
        <div>
            <h2 id="heading-{{ $item->id }}" class="m-0 p-0">
                <button
                    type="button"
                    data-accordion-target="#body-{{ $item->id }}"
                    aria-expanded="{{ $isFirst ? 'true' : 'false' }}"
                    aria-controls="body-{{ $item->id }}"
                    class="w-full text-left text-black px-3 py-2 text-[12px]"
                >
                    {{ \Illuminate\Support\Str::limit($item->name, 30, '...') }}

                </button>   
            </h2>

            <div id="body-{{ $item->id }}" class="hidden border-t px-3 py-2 bg-blue-100 p-[40px]" aria-labelledby="heading-{{ $item->id }}">
                
                {{-- Full item name displayed when open --}}
                <h3 class="text-lg font-semibold mb-2">{{ $item->name }}</h3>
                <p class="text-base text-gray-600 mb-2">Price: <strong>{{ $item->price }} €</strong></p>
                
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                    
                    {{-- Take Form --}}
                    <form method="POST" action="{{ route('taken.store', $item->id) }}" class="flex flex-1 flex-col md:flex-row gap-2">
                        @csrf
                        <input type="text" name="reason" placeholder="Reason" class="border px-2 py-1 w-full md:w-1/2" />
                        <div class="flex items-center gap-2 w-full md:w-auto justify-end">
                            <input type="number" name="count" min="1" max="{{ $item->stock }}" value="1" class="border px-2 py-1 w-20" />
                            <button type="submit" class="px-3 py-1 border bg-gray-100 hover:bg-gray-300 ">Take</button>
                        </div>
                    </form>

                    @can('update', $item)
                        {{-- Edit Button --}}
                        <a href="{{ route('items.edit', $item->id) }}" class="px-3 py-1 border bg-gray-100 hover:bg-gray-300">Edit</a>

                        {{-- Delete Form --}}
                        <form method="POST" action="{{ route('items.destroy', $item) }}">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-1 border bg-gray-100 hover:bg-gray-300">Delete</button>
                        </form>
                    @endcan
                    

                </div>
            </div>


        </div>
    @endforeach
    </div>


<div class="flex justify-center my-4">
    {{ $items->links('vendor.pagination.custom-tailwind') }}
</div>

</div>
    
</x-layouts.items>
