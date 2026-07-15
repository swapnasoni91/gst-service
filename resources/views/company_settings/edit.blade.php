<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Edit Company') }}</h2>
    </x-slot>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('company-settings.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Company Name</label>
                        <input type="text" name="company_name" class="form-control" value="{{ old('company_name', $setting->company_name) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">State</label>
                        <select name="state" class="form-select" required>
                            @foreach(config('states') as $state)
                                <option value="{{ $state }}" {{ (old('state', $setting->state) === $state) ? 'selected' : '' }}>
                                    {{ $state }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">GST Number</label>
                        <input type="text" name="gst_number" class="form-control" value="{{ old('gst_number', $setting->gst_number) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Company Logo</label>
                        <input type="file" name="company_logo" class="form-control" accept="image/*">
                        @if($setting->company_logo)
                            <div class="mt-2">
                                <img src="{{ asset('uploads/company/'.$setting->company_logo) }}" alt="Logo" style="max-width:120px; height:auto;">
                            </div>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $setting->phone) }}">
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" rows="3">{{ old('address', $setting->address) }}</textarea>
                    </div>

                    <div class="col-12">
                        <button class="btn btn-success" type="submit">{{ __('Update Company') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

