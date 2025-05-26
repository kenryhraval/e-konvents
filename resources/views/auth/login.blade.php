@vite('resources/css/app.css')
<x-layout>

<x-slot name="title">
    Login
</x-slot>

<div class="login-form-outer">
    <form method="POST" action="{{ route('login') }}" class="login-form-inner">
        @csrf

        <div class="form-field">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required value="{{ old('email') }}">
        </div>

        <div class="form-field">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit">Login</button>
    </form>
</div>

    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <div class="flex items-center m-10 text-sm text-red-500 rounded-sm bg-blue-50 border-1" role="alert">
                        <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>

                        <div>
                            {{ $error }}
                        </div>
                    </div>
                @endforeach
            </ul>
        </div>
    @endif

    
</x-layout>