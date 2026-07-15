<?php

use App\Models\CompanySetting;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;

?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Dashboard') }}</h2>
    </x-slot>

    @php
        $customerCount = Customer::where('user_id', auth()->id())->count();
        $productCount = Product::where('user_id', auth()->id())->count();
        $invoiceCount = Invoice::where('user_id', auth()->id())->count();

        $invoiceTotals = Invoice::where('user_id', auth()->id())
            ->selectRaw('COALESCE(SUM(subtotal),0) as subtotal_sum, COALESCE(SUM(gst_total),0) as gst_sum, COALESCE(SUM(grand_total),0) as grand_sum')
            ->first();

        $company = CompanySetting::where('user_id', auth()->id())->first();
    @endphp

    <div class="row g-3">
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="text-muted" style="font-size:13px;">Invoices</div>
                    <div class="display-6 fw-bold">{{ $invoiceCount }}</div>
                    <div class="text-muted" style="font-size:13px;">Grand Total: ₹{{ number_format($invoiceTotals->grand_sum ?? 0, 2) }}</div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="text-muted" style="font-size:13px;">Customers</div>
                    <div class="display-6 fw-bold">{{ $customerCount }}</div>
                    <div class="text-muted" style="font-size:13px;">State-wise GST calculations</div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="text-muted" style="font-size:13px;">Products</div>
                    <div class="display-6 fw-bold">{{ $productCount }}</div>
                    <div class="text-muted" style="font-size:13px;">GST % stored per product</div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="fw-bold">KPI Summary</div>
                            <div class="text-muted" style="font-size:13px;">Subtotal, Total GST, and Grand Total</div>
                        </div>
                        @if(!$company)
                            <a href="{{ route('company-settings.create') }}" class="btn btn-primary">Setup Company</a>
                        @else
                            <a href="{{ route('company-settings.edit', $company->id) }}" class="btn btn-outline-primary">Update Company</a>
                        @endif
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-md-4">
                            <div class="p-3 rounded-3" style="background:#e7f1ff;">
                                <div class="text-muted" style="font-size:13px;">Subtotal</div>
                                <div class="fw-bold" style="font-size:22px;">₹{{ number_format($invoiceTotals->subtotal_sum ?? 0, 2) }}</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 rounded-3" style="background:#fff5e6;">
                                <div class="text-muted" style="font-size:13px;">Total GST</div>
                                <div class="fw-bold" style="font-size:22px;">₹{{ number_format($invoiceTotals->gst_sum ?? 0, 2) }}</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 rounded-3" style="background:#eafff2;">
                                <div class="text-muted" style="font-size:13px;">Grand Total</div>
                                <div class="fw-bold" style="font-size:22px;">₹{{ number_format($invoiceTotals->grand_sum ?? 0, 2) }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="text-muted" style="font-size:13px;">Quick actions</div>
                        <div class="d-flex gap-2 flex-wrap mt-2">
                            <a class="btn btn-primary" href="{{ route('invoices.create') }}">Create Invoice</a>
                            <a class="btn btn-outline-primary" href="{{ route('customers.create') }}">Add Customer</a>
                            <a class="btn btn-outline-primary" href="{{ route('products.create') }}">Add Product</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

