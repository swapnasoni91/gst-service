<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'GST Billing') }}</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        <div class="min-vh-100 d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-6 col-lg-5">
                        <div class="card shadow-sm border-0">
                            <div class="card-body p-4">
                                <div class="text-center mb-3">
                                    <div class="d-inline-flex align-items-center justify-content-center rounded-3" style="width:72px;height:72px;background:#0d6efd22;">
                                        <div class="fw-bold" style="color:#0d6efd;font-size:28px;">GST</div>
                                    </div>
                                    <h2 class="mt-3 h4 mb-0">GST Billing</h2>
                                    <p class="text-muted mb-0" style="font-size:13px;">Login / Register to manage invoices</p>
                                </div>

                                {{ $slot }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>

