@vite('resources/css/app.css')
<x-layout>
    

    <form method="POST" action="{{ route('users.store') }}">
        <h1>Register</h1>
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required value="{{ old('name') }}">
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required value="{{ old('email') }}">
        </div>

        <div>
            <label for="birthdate">Birthdate:</label>
            <input type="date" id="birthdate" name="birthdate" value="{{ old('birthdate') }}">
        </div>

        {{-- <div>
            <label>Roles:</label>
            @foreach($roles as $role)
                <div>
                    <input 
                        type="checkbox" 
                        id="role_{{ $role->id }}" 
                        name="roles[]" 
                        value="{{ $role->id }}"
                        {{ in_array($role->id, old('roles')) ? 'checked' : '' }}
                    >
                    <label for="role_{{ $role->id }}">{{ $role->name }}</label>
                </div>
            @endforeach
        </div> --}}

        <button type="submit">Register</button>
    </form>

    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</x-layout>
