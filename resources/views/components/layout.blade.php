<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @if (session('success'))
        <div class="flash">
            {{ session('success') }}
        </div>
        
    @endif

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-konvents</title>

    @vite('resources/css/app.css')
</head>
<body>
    <div class="main">
        {{ $slot }}
    </div>
</body>
</html>