@vite('resources/css/app.css')
<x-layout>
<ul>
    @foreach ($items as $item)
        <li>
            <h1>
                <a href="{{ route('items.show', $item) }}">
                    {{ $item->name }}
                </a>
            </h1>
            $ {{ $item->price }} 
        </li>
    @endforeach
</ul>
    
</x-layout>
