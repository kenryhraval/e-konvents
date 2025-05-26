<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Flowbite --}}
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    {{-- Custom --}}
     @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    @if (session('success'))
    <div class="alert custom-alert alert-success alert-dismissible" role="alert">
        <div> {{ session('success') }} </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif


    <nav class="navbar">
        <div class="navbar-inner">
            <div class="navbar-left">
                <a href="#" class="brand uppercase">
                    <h1>e-konvents</h1>
                </a>
            </div>
            <ul class="navbar-right">
                @guest
                <li><a href="{{ route('show.login') }}" class="custom-button">LOGIN</a></li>
                @endguest

                @auth
                <li><a href="{{ route('events.index') }}" class="custom-button">EVENTS</a></li>
                <li><a href="{{ route('items.index') }}" class="custom-button">ITEMS</a></li>
                <li><a href="{{ route('users.index') }}" class="custom-button">USERS</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="custom-button">LOGOUT</button>
                    </form>
                </li>
                @endauth
            </ul>
        </div>
    </nav>

    @auth
    <sidebar class="sidebar">
        
        {{ $sidebar }}
    </sidebar>
    
    @endauth
    
    
    <div class="main">
        {{ $slot }}
    </div>
</body>
</html>