<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Company Settings') }}</h2>
    </x-slot>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            @if(!$setting)
                <div class="alert alert-warning">No company settings found.</div>
                <a href="{{ route('company-settings.create') }}" class="btn btn-primary">{{ __('Setup Company') }}</a>
            @else
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="p-3 rounded-3" style="background:#f6f7fb;">
                            @if($setting->company_logo)
                                <img src="{{ asset('uploads/company/'.$setting->company_logo) }}" alt="Logo" style="max-width:100%; height:auto;">
                            @else
                                <div class="text-muted">No logo</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-8">
                        <table class="table table-borderless">
                            <tr><th>Company Name</th><td>{{ $setting->company_name }}</td></tr>
                            <tr><th>GSTIN</th><td>{{ $setting->gst_number }}</td></tr>
                            <tr><th>State</th><td>{{ $setting->state }}</td></tr>
                            <tr><th>Phone</th><td>{{ $setting->phone }}</td></tr>
                            <tr><th>Address</th><td>{{ $setting->address }}</td></tr>
                        </table>

                        <a href="{{ route('company-settings.edit', $setting->id) }}" class="btn btn-primary">{{ __('Edit Company') }}</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

