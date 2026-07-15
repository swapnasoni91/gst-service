<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Create Customer') }}</h2>
    </x-slot>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('customers.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">{{ __('Name') }}</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('Email') }}</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('Phone') }}</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('GST Number') }}</label>
                        <input type="text" name="gst_number" class="form-control" value="{{ old('gst_number') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('State') }}</label>
                        <select name="state" class="form-select" required>
                            <option value="">Select State</option>
                            @foreach(config('states') as $state)
                                <option value="{{ $state }}" {{ old('state') === $state ? 'selected' : '' }}>{{ $state }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">{{ __('Address') }}</label>
                        <textarea name="address" class="form-control" rows="3">{{ old('address') }}</textarea>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-success">{{ __('Save Customer') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

