@vite('resources/css/app.css')
<x-layouts.items>

    @if ($items->count() > 0)

    <div id="accordion" data-accordion="collapse" class="border divide-y mx-auto my-5"
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
                        class="w-full text-left text-black px-3 py-5 !text-[18px] !uppercase"
                    >
                        {{$item->name}}
                    </button>   
                </h2>

                <div id="body-{{ $item->id }}" class="hidden border-t px-3 py-4 bg-blue-100 p-[40px]" aria-labelledby="heading-{{ $item->id }}">
                    
                    <p class="text-base text-gray-600 mb-2">
                        {{__('Price')}}: <strong>{{ $item->price }} €</strong>
                    </p>
                    
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                        
                        <form method="POST" action="{{ route('taken.store', $item) }}" class="flex flex-1 flex-col md:flex-row gap-2">
                            @csrf
                            <input type="text" name="reason" placeholder="{{__('Reason')}}" class="border px-2 py-1 w-full @error('reason') is-invalid @enderror" />
                            <div class="flex items-center gap-2 w-full md:w-auto justify-end">
                                <input type="number" name="count" min="1" value="1" class="border px-2 py-1 w-20 @error('count') is-invalid @enderror" />
                                <button type="submit" class="px-3 py-1 border bg-gray-100 hover:bg-gray-300 ">
                                    {{__('Take')}}
                                </button>
                            </div>

                            @if ($errors->any())
                                <div class="invalid-feedback d-block">
                                    {{ $errors->first() }}
                                </div>
                            @endif


                        </form>

                        @can('update', $item)
                            <a href="{{ route('items.edit', $item) }}" class="px-3 py-1 border bg-gray-100 text-center hover:bg-gray-300">
                                {{__('Edit')}}
                            </a>

                            <form method="POST" action="{{ route('items.destroy', $item) }}">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-1 border w-full bg-gray-100 hover:bg-gray-300">
                                    {{__('Delete')}}
                                </button>
                            </form>
                        @endcan
                        

                    </div>
                </div>


            </div>
        @endforeach
    </div>

    <div class="flex justify-center my-4 ">
        <div>
            {{ $items->links('vendor.pagination.custom-tailwind') }}
        </div>
        <div class="w-[25px]"> </div>
    </div>
    @else
    <div class="flex justify-center items-center h-40">
        <h3 class="italic text-gray-600 text-lg">{{__('No records meet the criteria')}}</h3>
    </div>
    @endif

</div>
    
</x-layouts.items>
