@vite('resources/css/app.css')
<x-layout>
     <x-slot name="title">
        Edit Profile
    </x-slot>

    <x-slot name="sidebar">
        User List
        <a href="{{ route('users.create') }}">CREATE USER</a>
    </x-slot>

    <h1>Edit User</h1>

    <form method="POST" action="{{ route('users.update', $user) }}">
        @csrf
        @method('PUT') <!-- This is necessary for update requests -->
        
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required value="{{ old('email', $user->email) }}">
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <small>If you want to change the password, enter it here.</small>
        </div>

        <div>
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
        </div>

        <div>
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
        </div>

        <div>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="{{ old('address', $user->address) }}">
        </div>

        {{-- <div>
            <label for="balance">Balance:</label>
            <input type="number" id="balance" name="balance" step="0.01" value="{{ old('balance', $user->balance) }}">
        </div>       --}}

        <button type="submit">Update User</button>
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
