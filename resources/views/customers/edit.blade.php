<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Edit Customer') }}</h2>
    </x-slot>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $customer->name) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $customer->email) }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $customer->phone) }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">GST Number</label>
                        <input type="text" name="gst_number" class="form-control" value="{{ old('gst_number', $customer->gst_number) }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">State</label>
                        <select name="state" class="form-select" required>
                            @foreach(config('states') as $state)
                                <option value="{{ $state }}" {{ (old('state', $customer->state) === $state) ? 'selected' : '' }}>
                                    {{ $state }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" rows="3">{{ old('address', $customer->address) }}</textarea>
                    </div>

                    <div class="col-12">
                        <button class="btn btn-success" type="submit">{{ __('Update Customer') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

