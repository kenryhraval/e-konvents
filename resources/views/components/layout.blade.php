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

    <nav class="navbar">
        <ul>
            <li class="brand">
                <h1>e-konvents</h1>
            </li>
    
            <!-- Guest Links -->
            @guest
            <li class="guest-link">
                <a href="{{ route('show.login') }}" class="btn">login</a>
            </li>
            @endguest
    
            <!-- Authenticated User Links -->
            @auth
            <li class="auth-user">
                <span>Hi there, {{ Auth::user()->name }}</span>
            </li>
            <li class="auth-link">
                <a href="{{ route('events.index') }}" class="btn">events</a>
            </li>
            <li class="auth-link">
                <a href="{{ route('events.create') }}" class="btn">new event</a>
            </li>
            <li class="auth-link">
                <a href="{{ route('items.index') }}" class="btn">items</a>
            </li>
            <li class="auth-link">
                <a href="{{ route('items.create') }}" class="btn">new item</a>
            </li>
            <li class="auth-link">
                <a href="{{ route('users.index') }}" class="btn">users</a>
            </li>
            <li class="auth-link">
                <a href="{{ route('users.create') }}" class="btn">new user</a>
            </li>
    
            <!-- Logout -->
            <li class="auth-link">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn">Logout</button>
                </form>
            </li>
            @endauth
        </ul>
    </nav>
    

    <div class="main">
        {{ $slot }}
    </div>
</body>
</html>