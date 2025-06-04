@vite('resources/css/app.css')
<x-layouts.base>

<div class="login-form-outer mx-auto max-w-[600px]">

    
    <form method="POST" action="{{ route('login') }}" class="login-form-inner needs-validation" validate>
        @csrf

        <div class="form-field">
            <label for="email" class="form-label">Email</label>
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
                Looks good!
            </div>

        </div>

        <div class="form-field w-full">
            <label for="password" class="form-label">Password</label>
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
                Looks good!
            </div>
        </div>

        <label>
            Unauthorized use of this system may be qualified as a criminal offense under the laws of the Relabelublic of Latvia, for which a penalty may be imposed in accordance with the Criminal Code.
        </label>

        <button type="submit" class="btn btn-primary w-full">Login</button>
    </form>
</div>

</x-layouts.base>
