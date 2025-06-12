@vite('resources/css/app.css')
<x-layouts.items>

    @if ($items->count() > 0)
    <div id="accordion" data-accordion="collapse" class="border divide-y mx-auto my-5 max-w-3xl"
     data-active-classes="bg-gray-800 text-white"
     data-inactive-classes="">
        @foreach ($items as $item)
        
        @php
            $isFirst = $loop->first;
        @endphp
            
            <div>
                <h2 id="heading-{{ $item->id }}" class="m-0">
                    <button
                        type="button"
                        data-accordion-target="#body-{{ $item->id }}"
                        aria-expanded="{{ $isFirst ? 'true' : 'false' }}"
                        aria-controls="body-{{ $item->id }}"
                        class="w-full text-left px-5 py-4 transition-colors"
                    >
                        <span class="font-mono text-2xl uppercase font-bold block">
                            {{$item->name}}
                        </span>
                    </button>   
                </h2>

                <div id="body-{{ $item->id }}" class="hidden border-t px-5 py-5 bg-blue-50" aria-labelledby="heading-{{ $item->id }}">
                    
                    <p class="text-lg text-gray-700 mb-4">
                        {{__('Price')}}: <span class="font-bold text-blue-600">{{ $item->price }} €</span>
                    </p>
                    
                    <div class="flex flex-wrap gap-2 gap-y-4 gap-x-6 w-full items-start justify-between">
                        {{-- Form with inputs + Take --}}
                        <form method="POST" action="{{ route('taken.store', $item) }}" class="flex-1 min-w-[250px]">
                            @csrf
                            <div class="flex flex-wrap gap-3 w-full">
                                <input 
                                    type="text" 
                                    name="reason" 
                                    placeholder="{{ __('Reason') }}" 
                                    class="flex-1 min-w-[150px] border px-3 py-2 rounded @error('reason') border-red-500 @enderror" 
                                />
                                <input 
                                    type="number" 
                                    name="count" 
                                    min="1" 
                                    value="1" 
                                    class="w-24 border px-3 py-2 rounded @error('count') border-red-500 @enderror" 
                                />
                                <button 
                                    type="submit" 
                                    class="px-4 py-2 bg-white border rounded font-medium whitespace-nowrap"
                                >
                                    {{ __('Take') }}
                                </button>
                            </div>

                            @if ($errors->any())
                                <div class="text-sm text-red-600 mt-2">
                                    {{ $errors->first() }}
                                </div>
                            @endif
                        </form>

                        {{-- Edit/Delete buttons --}}
                        @can('update', $item)
                        <div class="ml-2 flex flex-wrap gap-2">
                            <a href="{{ route('items.edit', $item) }}" class="px-4 py-2 bg-white border rounded font-medium w-[100px] text-center">
                                {{ __('Edit') }}
                            </a>

                            <form method="POST" action="{{ route('items.destroy', $item) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-white border rounded font-medium w-[100px] text-center">
                                    {{ __('Delete') }}
                                </button>
                            </form>
                        </div>
                        @endcan
                    </div>

                </div>
            </div>
        @endforeach
    </div>

    <div class="flex justify-center my-8">
        {{ $items->links('vendor.pagination.custom-tailwind') }}
    </div>
    @else
    <div class="flex justify-center items-center h-40">
        <h3 class="italic text-gray-600 text-lg">{{__('No records meet the criteria')}}</h3>
    </div>
    @endif
    
</x-layouts.items>  