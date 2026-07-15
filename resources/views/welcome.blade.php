<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'GST Billing') }}</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        <div class="container py-4">
            <div class="d-flex justify-content-end mb-4">
                {{-- @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-dark">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                        @endif
                    @endauth
                @endif --}}
            </div>

            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <div class="p-4 p-md-5 bg-white rounded-4 shadow-sm">
                        <h1 class="display-5 fw-bold">GST Billing Made Simple</h1>
                        <p class="text-muted fs-5 mb-3">
                            Manage customers & products, generate GST invoices with correct <b>CGST/SGST</b> or <b>IGST</b> breakup, and download a PDF.
                        </p>

                        <div class="row g-3 mt-2">
                            <div class="col-sm-4">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="https://dummyimage.com/56x56/ef4444/ffffff&text=GST" width="56" height="56" class="rounded" alt="GST" />
                                            <div>
                                                <div class="fw-semibold">GST Calculation</div>
                                                <div class="text-muted" style="font-size:13px;">State-wise CGST/SGST or IGST</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="https://dummyimage.com/56x56/2563eb/ffffff&text=INV" width="56" height="56" class="rounded" alt="Invoice" />
                                            <div>
                                                <div class="fw-semibold">Invoice Numbering</div>
                                                <div class="text-muted" style="font-size:13px;">Auto invoice no. with year sequence</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="https://dummyimage.com/56x56/10b981/ffffff&text=PDF" width="56" height="56" class="rounded" alt="PDF" />
                                            <div>
                                                <div class="fw-semibold">PDF Download</div>
                                                <div class="text-muted" style="font-size:13px;">Print-ready PDF tax invoice</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @auth
                            <div class="mt-4">
                                <a href="{{ url('/dashboard') }}" class="btn btn-success btn-lg">Go to Dashboard</a>
                            </div>
                        @else
                            <div class="mt-4">
                                <a href="{{ route('register') }}" class="btn btn-success btn-lg">Start Free</a>
                                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Log in</a>
                            </div>
                        @endauth
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <h4 class="fw-bold">How it works</h4>
                            <ol class="mt-3 mb-0">
                                <li class="mb-2">Add company details (GSTIN & State)</li>
                                <li class="mb-2">Create customers and products</li>
                                <li class="mb-2">Generate invoice & GST breakup</li>
                                <li>Download invoice as PDF</li>
                            </ol>
                            <div class="alert alert-success mt-4 mb-0">
                                Built for speed & accuracy in GST billing.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS (optional) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>

