<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Create Invoice') }}</h2>
    </x-slot>

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h4 class="fw-bold mb-3">Invoice Details</h4>

                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <div class="fw-bold mb-1">Validation error</div>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('invoices.store') }}" method="POST">
                            @csrf

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Customer</label>
                                    <select name="customer_id" class="form-select">
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12">
                                    <h5 class="mt-3">Products</h5>
                                </div>

                                <div class="col-md-6">
                                    <select name="products[]" class="form-select">
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <input type="number" name="quantities[]" class="form-control" placeholder="Quantity" min="1">
                                </div>

                                <div class="col-md-3 d-flex align-items-end">
                                    <button class="btn btn-success w-100" type="submit">Save Invoice</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

