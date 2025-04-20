<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-konvents</title>

    @vite('resources/css/app.css')
</head>

<body>
    @if (session('success'))
        <div class="flash">
            {{ session('success') }}
        </div>
        
    @endif

    <header>
        <nav>
            <h1>e-konvents</h1>
            
            @guest
                <a href="{{ route('show.login') }}" class="btn">login</a>
            @endguest

            @auth
                <a href="{{ route('events.index') }}">events    </a>
                <a href="{{ route('events.create') }}" class="btn">new event</a>
                <a href="{{ route('items.index') }}" class="btn">items</a>
                <a href="{{ route('items.create') }}" class="btn">new item</a>
                <a href="{{ route('users.index') }}" class="btn">users</a>
                <a href="{{ route('users.create') }}" class="btn">new user</a>
                <span>
                    Hi there, {{ Auth::user()->name }}
                </span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn"> Logout </button>
                </form>
            @endauth
        </nav>
    </header>

    <div class="main">
        {{ $slot }}
    </div>
</body>
</html>