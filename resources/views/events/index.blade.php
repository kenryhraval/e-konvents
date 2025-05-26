@vite('resources/css/app.css')

<x-layout>
    <x-slot name="title">
        Events
    </x-slot>

    <x-slot name="sidebar">
        Events Display
    </x-slot>

<div class="relative max-w-full">
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

    <div id="carousel" class="overflow-x-hidden scroll-smooth snap-x snap-mandatory flex gap-4 px-2">
    @php
// Example arrays of images per dresscode type
$suitImages = [
    'full suit' => [
        'https://source.unsplash.com/400x225/?suit,formal',
        'https://source.unsplash.com/400x225/?business,suit',
    ],
    'semi-formal' => [
        'https://source.unsplash.com/400x225/?semi-formal,dress',
        'https://source.unsplash.com/400x225/?cocktail,dress',
    ],
    'default' => [
        'https://source.unsplash.com/400x225/?casual,party',
        'https://source.unsplash.com/400x225/?casual,people',
    ],
];
@endphp

@foreach ($events as $event)
    @php
        $dressCode = strtolower($event->dresscode);
        $bgColor = match($dressCode) {
            'full suit' => 'bg-primary-subtle',
            'semi-formal' => 'bg-info-subtle',
            default => 'bg-light',
        };
        $images = $suitImages[$dressCode] ?? $suitImages['default'];
        $randomImage = $images[array_rand($images)];
    @endphp

    <div class="snap-start shrink-0 max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700" style="width: 18rem;">
        <a href="{{ route('events.show', $event) }}">
            <img class="rounded-t-lg w-full h-40 object-cover" src="{{ $randomImage }}" alt="Event image for {{ $event->name }}" />
        </a>
        <div class="p-5">
            <a href="{{ route('events.show', $event) }}">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ Str::limit($event->name, 40) }}</h5>
            </a>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $event->datetime->format('jS \o\f F, H:i') }}</p>
            <p class="mb-3 font-semibold text-gray-800 dark:text-gray-300">Dresscode: <span class="italic">{{ ucfirst($event->dresscode) }}</span></p>
            <a href="{{ route('events.show', $event) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Read more
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a>
        </div>
    </div>
@endforeach

    </div>

    
</div>






</x-layout>
