<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Invoice') }}: {{ $invoice->invoice_no }}</h2>
    </x-slot>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-3">

                <div>
                    <div class="text-muted" style="font-size:13px;">Tax Invoice</div>
                    <h3 class="mb-0">{{ $invoice->invoice_no }}</h3>
                    <div class="text-muted" style="font-size:13px;">{{ date('d-m-Y', strtotime($invoice->invoice_date)) }}</div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('invoices.pdf', $invoice->id) }}" class="btn btn-danger">Download PDF</a>
                    <button type="button" onclick="openInvoicePrint()" class="btn btn-primary">Print</button>

                </div>
            </div>

            <div id="printable-invoice">
                <div class="row g-3">
                    <div class="col-md-6">

                        @if($company && $company->company_logo)
                            <img src="{{ asset('uploads/company/'.$company->company_logo) }}" width="120" class="mb-3" alt="Company Logo">
                        @endif
                        <h4 class="mb-1">{{ $company->company_name ?? '' }}</h4>
                        <div class="text-muted mb-1">GST: {{ $company->gst_number ?? '' }}</div>
                        <div class="text-muted mb-1">Phone: {{ $company->phone ?? '' }}</div>
                        <div class="text-muted">Address: {{ $company->address ?? '' }}</div>
                    </div>

                    <div class="col-md-6">
                        <h5>Customer Details</h5>
                        <div class="mt-2">
                            <div><b>Name:</b> {{ $invoice->customer->name }}</div>
                            <div><b>Email:</b> {{ $invoice->customer->email }}</div>
                            <div><b>Phone:</b> {{ $invoice->customer->phone }}</div>
                            <div><b>GST Number:</b> {{ $invoice->customer->gst_number }}</div>
                            <div><b>State:</b> {{ $invoice->customer->state }}</div>
                            <div><b>Address:</b> {{ $invoice->customer->address }}</div>
                        </div>
                    </div>
                </div>


            <hr class="my-4">

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>CGST</th>
                            <th>SGST</th>
                            <th>IGST</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoice->items as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->product->name }}</td>
                                <td>₹{{ $item->price }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>
                                    {{ $item->cgst_percent }}%<br>
                                    ₹{{ $item->cgst_amount }}
                                </td>
                                <td>
                                    {{ $item->sgst_percent }}%<br>
                                    ₹{{ $item->sgst_amount }}
                                </td>
                                <td>
                                    {{ $item->igst_percent }}%<br>
                                    ₹{{ $item->igst_amount }}
                                </td>
                                <td>₹{{ $item->total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row justify-content-end">
                <div class="row justify-content-end">
                    <div class="col-md-4">
                        <table class="table">

                            <tr>

                            <th>Subtotal</th>
                            <td class="text-end">₹{{ $invoice->subtotal }}</td>
                        </tr>
                        <tr>
                            <th>Total GST</th>
                            <td class="text-end">₹{{ $invoice->gst_total }}</td>
                        </tr>
                        <tr>
                            <th>Grand Total</th>
                            <td class="text-end fw-bold">₹{{ $invoice->grand_total }}</td>
                        </tr>
                    </table>
                </div>
            </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function openInvoicePrint() {
            const invoiceEl = document.getElementById('printable-invoice');
            if (!invoiceEl) return;

            const printWindow = window.open('', '_blank', 'width=900,height=650');
            if (!printWindow) {
                alert('Please allow popups to print the invoice.');
                return;
            }

            printWindow.document.open();
            printWindow.document.write(`<!DOCTYPE html><html><head><title>Print Invoice</title>
                <style>
                    body { font-family: DejaVu Sans, sans-serif; color:#000; margin: 20px; }
                    table { width: 100%; border-collapse: collapse; }
                    th, td { border: 1px solid #000; padding: 6px; }
                    .text-end { text-align: right; }
                    .fw-bold { font-weight: bold; }
                </style>
                </head><body></body></html>`);
            printWindow.document.close();

            // Append printable HTML only
            printWindow.document.body.appendChild(invoiceEl.cloneNode(true));

            printWindow.focus();
            printWindow.print();
            printWindow.close();
        }
    </script>
</x-app-layout>


