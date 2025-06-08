<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? __('e-konvents') }}</title>
    
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
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('Close') }}"></button>
    </div>
    @endif

    <nav class="navbar">
        <div class="navbar-inner flex-col md:flex-row">
            <div class="navbar-left flex justify-between items-center w-full max-w-xs md:max-w-none">
                <a href="{{ route('events.index') }}" class="brand uppercase">
                    <h1>{{ __('e-konvents') }}</h1>
                </a>

                <div>
                    @php
                        $current = app()->getLocale();
                        $other = $current === 'en' ? 'lv' : 'en';
                        $labels = ['en' => 'EN', 'lv' => 'LV'];
                    @endphp

                    <a href="{{ url('lang/' . $other) }}" class="!text-gray-500  text-3xl pe-5">
                        {{ $labels[$other] }}
                    </a>
                </div>
            </div>


            <ul class="navbar-right flex-col md:flex-row hidden md:flex w-full md:w-auto">
                @guest
                <li><a href="{{ route('show.login') }}" class="custom-button">{{ __('Login') }}</a></li>
                @endguest

                @auth
                <li class="m-0"><a href="{{ route('events.index') }}" class="custom-button">{{ __('Events') }}</a></li>
                <li><a href="{{ route('items.index') }}" class="custom-button">{{ __('Items') }}</a></li>
                <li><a href="{{ route('users.index') }}" class="custom-button">{{ __('Users') }}</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="custom-button">{{ __('Logout') }}</button>
                    </form>
                </li>
                @endauth
            </ul>
        </div>
    </nav>

    @auth
    <aside class="sidebar">
        {{ $sidebar ?? '' }}
    </aside>
    @endauth

    <main class="main">
        {{ $slot }}
    </main>

</body>
</html>
