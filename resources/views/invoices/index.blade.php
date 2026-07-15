<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center justify-content-between gap-2">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Invoices') }}</h2>
            <a href="{{ route('invoices.create') }}" class="btn btn-primary">{{ __('Create Invoice') }}</a>
        </div>
    </x-slot>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>Invoice No</th>
                            <th>Customer</th>
                            <th>Subtotal</th>
                            <th>GST</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->invoice_no }}</td>
                                <td>{{ $invoice->customer->name ?? '-' }}</td>
                                <td>₹{{ $invoice->subtotal }}</td>
                                <td>₹{{ $invoice->gst_total }}</td>
                                <td>₹{{ $invoice->grand_total }}</td>
                                <td>
                                    <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-info btn-sm">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

