@vite('resources/css/app.css')
<x-layouts.users>
    <x-slot name="title">
        {{__('Edit Profile')}}
    </x-slot>

    <div class="container my-5 lg:!px-[120px]">


    <form method="POST" action="{{ route('users.update', $user) }}" class="card shadow-sm p-4 bg-light rounded ">
        
        <h3> {{ $user->name }} </h3>  
        

        @csrf
            @method('PUT')

            <div class="mb-3 flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
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

                <div class="flex items-end"> 
                    @if (auth()->id() === $user->id)
                        @if ($user->google_id)
                            <div class="inline-flex w-full items-center h-[37px] gap-2 text-sm font-medium text-green-700 bg-green-50 border border-green-200 px-4 py-2 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                {{ __('Google Linked') }}
                            </div>
                        @else
                            <a href="{{ route('auth.google') }}"
                            class="inline-flex w-full items-center h-[37px] gap-2 text-sm text-white bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg font-medium transition whitespace-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 488 512" fill="currentColor">
                                    <path d="M488 261.8c0-17.8-1.5-35-4.3-51.6H249v97.8h134.6c-5.8 31.3-23.7 57.8-50.6 75.6v62.7h81.8c47.8-44 74.2-108.8 74.2-184.5z"/>
                                    <path d="M249 508c67.6 0 124.3-22.4 165.8-60.9l-81.8-62.7c-22.8 15.3-51.9 24.3-84 24.3-64.7 0-119.4-43.7-139-102.4h-84.1v64.6C73.4 445.1 153.9 508 249 508z"/>
                                    <path d="M110 305.9c-4.7-13.7-7.4-28.2-7.4-43s2.7-29.3 7.4-43v-64.6h-84.1C10.2 197.1 0 222.1 0 249s10.2 51.9 25.9 72.6L110 305.9z"/>
                                    <path d="M249 100.3c35.6 0 67.4 12.3 92.4 36.4l69.3-69.3C373.3 25.1 319.6 0 249 0 153.9 0 73.4 62.9 41.8 151.3l84.1 64.6C129.6 144 184.3 100.3 249 100.3z"/>
                                </svg>
                                {{ __('Link Google') }}
                            </a>
                        @endif
                    @else
                        @if ($user->google_id)
                            <div class="inline-flex w-full items-center h-[37px] gap-2 text-sm font-medium text-green-700 bg-green-50 border border-green-200 px-4 py-2 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                {{ __('Google Linked') }}
                            </div>
                        @else
                            <a class="inline-flex w-full items-center h-[37px] gap-2 text-sm text-white bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg font-medium transition whitespace-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 488 512" fill="currentColor">
                                    <path d="M488 261.8c0-17.8-1.5-35-4.3-51.6H249v97.8h134.6c-5.8 31.3-23.7 57.8-50.6 75.6v62.7h81.8c47.8-44 74.2-108.8 74.2-184.5z"/>
                                    <path d="M249 508c67.6 0 124.3-22.4 165.8-60.9l-81.8-62.7c-22.8 15.3-51.9 24.3-84 24.3-64.7 0-119.4-43.7-139-102.4h-84.1v64.6C73.4 445.1 153.9 508 249 508z"/>
                                    <path d="M110 305.9c-4.7-13.7-7.4-28.2-7.4-43s2.7-29.3 7.4-43v-64.6h-84.1C10.2 197.1 0 222.1 0 249s10.2 51.9 25.9 72.6L110 305.9z"/>
                                    <path d="M249 100.3c35.6 0 67.4 12.3 92.4 36.4l69.3-69.3C373.3 25.1 319.6 0 249 0 153.9 0 73.4 62.9 41.8 151.3l84.1 64.6C129.6 144 184.3 100.3 249 100.3z"/>
                                </svg>
                                {{ __('Not Linked') }}
                            </a>
                        @endif
                    
                    @endif
                </div>
            </div>


            @if (auth()->id() === $user->id)
                <div class="mb-3">
                    <label for="password" class="form-label">{{__('Password')}}</label>
                    <input type="password" name="password" id="password"
                        class="form-control @error('password') is-invalid @enderror">
                    <small class="form-text text-muted">
                        {{__('If you want to change the password, enter it here.')}}
                    </small>
                    <div class="invalid-feedback">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">{{__('Confirm Password')}}</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="form-control">
                </div>
            @endif

            <div class="mb-3">
                <label for="phone_number" class="form-label">{{__('Phone')}}</label>
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
                <label for="address" class="form-label">{{__('Address')}}</label>
                <input type="text" name="address" id="address"
                    value="{{ old('address', $user->address) }}"
                    class="form-control @error('address') is-invalid @enderror">
                <div class="invalid-feedback">
                    @error('address')
                        {{ $message }}
                    @enderror
                </div>
            </div>


            @can('delete', \App\Models\User::class)
                <div class="mb-3">
                    <label for="balance" class="form-label">{{__('Balance')}}</label>
                    <input type="number" name="balance" id="balance" step="0.01"
                        value="{{ old('balance', $user->balance) }}"
                        class="form-control @error('balance') is-invalid @enderror">
                    <div class="invalid-feedback">
                        @error('balance')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="d-flex gap-5 mb-3 ">
                    <div class="w-[250px]">
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
                        <div class="d-flex flex-wrap gap-0">
                            @foreach ($roleTypes as $roleType)
                                <div class="form-check w-[140px]">
                                    <input class="p-2" type="checkbox"
                                        name="positions[]"
                                        value="{{ $roleType->id }}"
                                        id="position_{{ $roleType->id }}"
                                        {{ in_array($roleType->id, old('positions', $user->positions->pluck('role_type_id')->toArray())) ? 'checked' : '' }}>
                                    
                                    <label for="position_{{ $roleType->id }}">
                                        {{ $roleType->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>


                </div>           
            @endcan
            

            <button type="submit" class="btn btn-success">{{__('Update User')}}</button>
        </form>
    </div>

</x-layouts.users>
