@vite('resources/css/app.css')

<x-layouts.events>
    <x-slot name="title">
        {{__('Events')}}
    </x-slot>

<div class="relative max-w-full py-5">

    @if($events->count() > 1)
        <button id="prev" class="absolute left-0 top-1/2 -translate-y-1/2 z-10" aria-label="Previous">
            <!-- Left arrow SVG -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <button id="next" class="absolute right-0 top-1/2 -translate-y-1/2 z-10" aria-label="Next">
            <!-- Right arrow SVG -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    @endif

    @if($events->count() > 0)
    <div id="carousel" class="overflow-x-hidden scroll-smooth snap-x snap-mandatory flex gap-4 !mx-12">
        @foreach ($events as $event)
            @php
                $imgSrc = $event->image_path
                    ? asset('storage/' . $event->image_path)
                    : asset('images/sample' . rand(1, 5) . '.jpg');

                $dressCode = strtolower($event->dresscode);
                $bgColor = match($dressCode) {
                    'full suit'    => 'bg-primary-subtle',
                    'semi-formal'  => 'bg-info-subtle',
                    default        => 'bg-light',
                };

                $userDuty = $event->duties->where('user_id', auth()->id())->first();
            @endphp

            <div class="snap-start shrink-0 max-w-sm {{ $bgColor }} border rounded-lg shadow-sm" style="width: 18rem;">
                <a href="{{ route('events.show', $event) }}">
                    <img
                        class="rounded-t-lg w-full h-40 object-cover"
                        src="{{ $imgSrc }}"
                        alt="Event image for {{ $event->name }}" />
                
                    <div class="p-5">
                        <h5 class="mb-3 h-[80px] text-2xl font-bold tracking-tight text-gray-900">
                            {{ Str::limit($event->name, 40) }}
                        </h5>
                        <p class="mb-3 font-normal text-gray-700">
                            {{ $event->datetime->format('jS \\o\\f F, H:i') }}
                        </p>
                        <p class="mb-3 font-semibold text-gray-800">
                            {{__('Dresscode')}}:
                            <span class="italic">{{ ucfirst($event->dresscode) }}</span>
                        </p>

                        @if ($userDuty)
                        <div class="mt-4">
                            <p class="font-semibold text-blue-800 mb-1">
                                {{__('Your role')}}: <i>"{{ $userDuty->details }} </i>"
                            </p>
                        </div>
                    @endif
                        
                    </div>

                    
                </a>
            </div>
        @endforeach
    </div>
    
    @else
    <div class="flex justify-center items-center h-40">
        <h3 class="italic text-gray-600 text-lg">{{__('No records meet the criteria')}}</h3>
    </div>
    @endif


    
</div>




</x-layouts.events>
