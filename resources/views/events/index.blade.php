@vite('resources/css/app.css')
<x-layout>
<ul>
    @foreach ($events as $event)
        <li>
            <h1>
                {{ $event->name }}
            </h1>
            {{ $event->description }} <br>
            {{ $event->dresscode }} <br>
            {{ $event->datetime }}
        </li>
    @endforeach
</ul>
    
</x-layout>
