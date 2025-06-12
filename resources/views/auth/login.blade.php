@vite('resources/css/app.css')
<x-layouts.base>

<main class="main">
<div class="login-form-outer mx-auto max-w-[600px]">
    
    <form method="POST" action="{{ route('login') }}" class="login-form-inner needs-validation" validate>
        @csrf

        <div class="form-field">
            <label for="email" class="form-label">{{__('Email')}}</label>
            <input
                type="email"
                id="email"
                name="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}"
                required
            >
            <div class="invalid-feedback">
                @error('email')
                    {{ $message }}
                @enderror
            </div>
            <div class="valid-feedback">
                {{__('Looks good!')}}
            </div>

        </div>

        <div class="form-field w-full">
            <label for="password" class="form-label">{{__('Password')}}</label>
            <input
                type="password"
                id="password"
                name="password"
                class="form-control @error('password') is-invalid @enderror"
                required
            >

            <div class="invalid-feedback">
                @error('password')
                    {{ $message }}
                @enderror
            </div>
            <div class="valid-feedback">
                {{__('Looks good!')}}
            </div>
        </div>

        <label>
            {{__('Unauthorized use of this system may be qualified as a criminal offense under the laws of the Republic of Latvia, for which a penalty may be imposed in accordance with the Criminal Code.')}}
        </label>

        <button type="submit" class="btn btn-primary w-full">{{__('Login')}}</button>
    
        <div class="mt-6 w-full">
            <a href="{{ route('auth.google') }}"
            class="block w-full text-white bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg font-semibold shadow transition">
                <div class="flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 488 512" fill="currentColor">
                        <path d="M488 261.8c0-17.8-1.5-35-4.3-51.6H249v97.8h134.6c-5.8 31.3-23.7 57.8-50.6 75.6v62.7h81.8c47.8-44 74.2-108.8 74.2-184.5z"/>
                        <path d="M249 508c67.6 0 124.3-22.4 165.8-60.9l-81.8-62.7c-22.8 15.3-51.9 24.3-84 24.3-64.7 0-119.4-43.7-139-102.4h-84.1v64.6C73.4 445.1 153.9 508 249 508z"/>
                        <path d="M110 305.9c-4.7-13.7-7.4-28.2-7.4-43s2.7-29.3 7.4-43v-64.6h-84.1C10.2 197.1 0 222.1 0 249s10.2 51.9 25.9 72.6L110 305.9z"/>
                        <path d="M249 100.3c35.6 0 67.4 12.3 92.4 36.4l69.3-69.3C373.3 25.1 319.6 0 249 0 153.9 0 73.4 62.9 41.8 151.3l84.1 64.6C129.6 144 184.3 100.3 249 100.3z"/>
                    </svg>
                    {{ __('Login with Google') }}
                </div>
            </a>
        </div>
    
    </form>

</div>
</main>

</x-layouts.base>

<script>
    window.loginValidationMessages = {
        email: {
            required: "{{ __('email_required') }}",
            email: "{{ __('email_invalid') }}"
        },
        password: {
            required: "{{ __('password_required') }}"
        }
    };
</script>
