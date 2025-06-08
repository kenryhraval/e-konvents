<x-layouts.events>
    <x-slot name="title">
        {{__('Edit Event')}}
    </x-slot>

    <div class="container my-5 lg:!px-[120px]">
        
        <form method="POST" action="{{ route('events.update', $event) }}"
            enctype="multipart/form-data"
            class="card shadow-sm p-4 bg-light rounded">

            <h1 class="mb-4 text-2xl font-bold">{{__('Edit Event')}}</h1>
            
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">{{__('Event Name')}}</label>
                <input type="text" name="name" id="name"
                       value="{{ old('name', $event->name) }}"
                       required
                       class="form-control @error('name') is-invalid @enderror">

                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">{{__('Description')}}</label>
                <textarea name="description" id="description"
                          required
                          class="form-control h-32 resize-none @error('description') is-invalid @enderror">{{ old('description', $event->description) }}</textarea>

                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-4 ">

                <div class="flex-col">
                    {{-- Dresscode --}}
                    <div class="flex-fill mb-3">
                        <label for="dresscode" class="form-label">{{__('Dresscode')}}</label>
                        <select name="dresscode" id="dresscode"
                                required
                                class="form-select @error('dresscode') is-invalid @enderror">
                            <option value="" disabled>{{__('Select a dresscode')}}</option>
                            @foreach (['Full suit', 'Semi-formal', 'Casual', 'Traditional', 'Theme costume'] as $dresscode)
                                <option value="{{ $dresscode }}" {{ old('dresscode', $event->dresscode) == $dresscode ? 'selected' : '' }}>
                                    {{ $dresscode }}
                                </option>
                            @endforeach
                        </select>
                        @error('dresscode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Datetime --}}
                    <div class="flex-fill mb-3" >
                        <label for="datetime" class="form-label">{{__('Event Date & Time')}}</label>
                        <input type="datetime-local" name="datetime" id="datetime"
                            value="{{ old('datetime', $event->datetime->format('Y-m-d\TH:i')) }}"
                            required
                            class="form-control @error('datetime') is-invalid @enderror">
                        @error('datetime')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                

                {{-- Image Preview & Upload --}}
                <div class="flex-fill mb-3 text-left">
                    <label class="form-label d-block">{{ __('Event Image') }}</label>
                    <div class="mb-2 mx-auto">
                        <img id="image-preview"
                            src="{{ $event->image_path ? asset('storage/' . $event->image_path) : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRGh5WFH8TOIfRKxUrIgJZoDCs1yvQ4hIcppw&s' }}"
                            alt="Event Image"
                            class="rounded img-fluid shadow-sm w-full">
                    </div>
                    <input type="file" name="image" id="image"
                        accept="image/*"
                        class="form-control d-none @error('image') is-invalid @enderror">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>




            <button type="submit" class="btn btn-success">{{__('Update Event')}}</button>
        </form>
    </div>
</x-layouts.events>
