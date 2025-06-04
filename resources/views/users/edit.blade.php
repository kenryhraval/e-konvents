@vite('resources/css/app.css')
<x-layouts.users>
     <x-slot name="title">
        Edit Profile
    </x-slot>

    <form method="POST" action="{{ route('users.update', $user) }}" class="card shadow-sm p-4 bg-light rounded">
        <h3> {{ $user->name }} </h3>    
        @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email"
                    value="{{ old('email', $user->email) }}"
                    required
                    class="form-control @error('email') is-invalid @enderror">
                <div class="invalid-feedback">
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password"
                    class="form-control @error('password') is-invalid @enderror">
                <small class="form-text text-muted">If you want to change the password, enter it here.</small>
                <div class="invalid-feedback">
                    @error('password')
                        {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="form-control">
            </div>

            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone</label>
                <input type="text" name="phone_number" id="phone_number"
                    value="{{ old('phone_number', $user->phone_number) }}"
                    class="form-control @error('phone_number') is-invalid @enderror">
                <div class="invalid-feedback">
                    @error('phone_number')
                        {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" id="address"
                    value="{{ old('address', $user->address) }}"
                    class="form-control @error('address') is-invalid @enderror">
                <div class="invalid-feedback">
                    @error('address')
                        {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="balance" class="form-label">Balance</label>
                <input type="number" name="balance" id="balance" step="0.01"
                    value="{{ old('balance', $user->balance) }}"
                    class="form-control @error('balance') is-invalid @enderror">
                <div class="invalid-feedback">
                    @error('balance')
                        {{ $message }}
                    @enderror
                </div>
            </div>

            @php
                $adminRoles = ['admin', 'item', 'event'];
                $positionOptions = ['kr!', 'com!', 'fil!', 't/l kasieris', 't/l sekretārs', 't/l seniors', 'b!fil!'];
            @endphp

            <div class="d-flex gap-5 mb-3 ">
                <div>
                    <label class="form-label">Admin Roles</label>
                    @foreach ($adminRoles as $role)
                        <div class="form-check">
                            <input class="form-check-input p-2"
                                type="checkbox"
                                name="admin_types[]"
                                value="{{ $role }}"
                                id="admin_{{ $role }}"
                                {{ in_array($role, old('admin_types', $user->admins->pluck('type')->toArray())) ? 'checked' : '' }}>
                            <label class="form-check-label" for="admin_{{ $role }}">
                                {{ ucfirst($role) }}
                            </label>
                        </div>
                    @endforeach
                </div>

                <div>
                    <label class="form-label">Positions</label>
                    @foreach ($positionOptions as $pos)
                        <div class="form-check">
                            <input class="form-check-input p-2"
                                type="checkbox"
                                name="positions[]"
                                value="{{ $pos }}"
                                id="position_{{ $loop->index }}"
                                {{ in_array($pos, old('positions', $user->positions->pluck('type')->toArray())) ? 'checked' : '' }}>
                            <label class="form-check-label" for="position_{{ $loop->index }}">
                                {{ $pos }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>


        </div>

           

            <button type="submit" class="btn btn-success">Update User</button>
        </form>

</x-layouts.users>
