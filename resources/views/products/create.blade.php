<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Create Product') }}</h2>
    </x-slot>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Price</label>
                        <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Stock</label>
                        <input type="number" name="stock" class="form-control" value="{{ old('stock') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">GST Percent</label>
                        <input type="number" step="0.01" name="gst_percent" class="form-control" value="{{ old('gst_percent') }}" required>
                    </div>

                    <div class="col-12">
                        <button class="btn btn-success" type="submit">{{ __('Save Product') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

