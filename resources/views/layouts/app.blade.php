<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'GST Billing') }}</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body { background: #f6f7fb; }
            .app-sidebar {
                min-height: calc(100vh - 56px);
                background: #0b1220;
                color: #cbd5e1;
            }
            .app-sidebar a { color: inherit; text-decoration: none; }
            .app-sidebar .menu-item { padding: 10px 12px; border-radius: 10px; display:flex; align-items:center; gap:10px; }
            .app-sidebar .menu-item:hover { background: rgba(255,255,255,0.08); }
            .app-sidebar .menu-item.active { background: rgba(13,110,253,0.25); color: #ffffff; }
            .app-sidebar .submenu { margin-left: 14px; margin-top: 6px; margin-bottom: 6px; }
            .app-sidebar .submenu a { padding: 8px 10px; display:flex; align-items:center; border-radius: 10px; }
            .app-sidebar .submenu a.active { background: rgba(13,110,253,0.25); color:#fff; }
            .app-content { padding: 20px 18px; }
        </style>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body>
        <!-- Top bar -->
        <nav class="navbar navbar-dark" style="background:#0b1220;">
            <div class="container-fluid">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;background:#0d6efd22;">
                        <span style="font-weight:800;color:#0d6efd;">GST</span>
                    </div>
                    <span class="navbar-brand mb-0 h1" style="font-size:16px;">GST Billing</span>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <div class="dropdown">
                        <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('company-settings.index') }}">Company</a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="m-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item" style="background:transparent;">Sign out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row g-0">
                <!-- Sidebar -->
                <aside class="col-md-3 col-lg-2 app-sidebar pt-3">
                    <div class="px-3 mb-3">
                        <div class="text-white fw-bold" style="font-size:14px;">Menu</div>
                    </div>

                    @php
                        $route = request()->route() ? request()->route()->getName() : null;
                        $is = function($names) use ($route) {
                            foreach ((array)$names as $n) {
                                if ($route === $n) return true;
                            }
                            return false;
                        };
                    @endphp

                    @php
                        $companyExists = \App\Models\CompanySetting::where('user_id', Auth::id())->exists();
                        $guard = function($url) use ($companyExists) {
                            return $companyExists ? $url : 'javascript:void(0)';
                        };
                    @endphp

                    <a href="{{ route('dashboard') }}" class="menu-item {{ $is('dashboard') ? 'active' : '' }}">
                        <span>🏠</span><span>Dashboard</span>
                    </a>

                    <div class="mt-2 px-3">
                        <div class="text-uppercase" style="font-size:12px; letter-spacing:0.04em; opacity:0.8;">Invoices</div>
                        <div class="submenu">
                            <a href="{{ route('invoices.index') }}"
                               onclick="if(!({{ $companyExists ? 'true' : 'false' }})) { event.preventDefault(); window.alert('Please complete company setup before accessing invoices.'); }"
                               class="{{ $route === 'invoices.index' ? 'active' : '' }}">
                                📄 <span style="font-size:13px;">List</span>
                            </a>

                            <a href="{{ route('invoices.create') }}"
                               onclick="if(!({{ $companyExists ? 'true' : 'false' }})) { event.preventDefault(); window.alert('Please complete company setup before accessing invoices.'); }"
                               class="{{ $route === 'invoices.create' ? 'active' : '' }}">
                                ➕ <span style="font-size:13px;">Create</span>
                            </a>
                        </div>
                    </div>

                    <div class="mt-2 px-3">
                        <div class="text-uppercase" style="font-size:12px; letter-spacing:0.04em; opacity:0.8;">Customers</div>
                        <div class="submenu">
                            <a href="{{ route('customers.index') }}"
                               onclick="if(!({{ $companyExists ? 'true' : 'false' }})) { event.preventDefault(); window.alert('Please complete company setup before accessing customers.'); }"
                               class="{{ $route === 'customers.index' ? 'active' : '' }}">
                                👥 <span style="font-size:13px;">List</span>
                            </a>
                            <a href="{{ route('customers.create') }}"
                               onclick="if(!({{ $companyExists ? 'true' : 'false' }})) { event.preventDefault(); window.alert('Please complete company setup before accessing customers.'); }"
                               class="{{ $route === 'customers.create' ? 'active' : '' }}">
                                ➕ <span style="font-size:13px;">Create</span>
                            </a>
                        </div>
                    </div>

                    <div class="mt-2 px-3 pb-4">
                        <div class="text-uppercase" style="font-size:12px; letter-spacing:0.04em; opacity:0.8;">Products</div>
                        <div class="submenu">
                            <a href="{{ route('products.index') }}"
                               onclick="if(!({{ $companyExists ? 'true' : 'false' }})) { event.preventDefault(); window.alert('Please complete company setup before accessing products.'); }"
                               class="{{ $route === 'products.index' ? 'active' : '' }}">
                                📦 <span style="font-size:13px;">List</span>
                            </a>
                            <a href="{{ route('products.create') }}"
                               onclick="if(!({{ $companyExists ? 'true' : 'false' }})) { event.preventDefault(); window.alert('Please complete company setup before accessing products.'); }"
                               class="{{ $route === 'products.create' ? 'active' : '' }}">
                                ➕ <span style="font-size:13px;">Create</span>
                            </a>
                        </div>
                    </div>
                </aside>


                <!-- Content -->
                <main class="col-md-9 col-lg-10 app-content">
                    @isset($header)
                        <div class="mb-3">
                            {{ $header }}
                        </div>
                    @endisset

                    {{ $slot }}
                </main>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Flash warning/toast (for company setup gating) -->
        <script>
            window.addEventListener('flash:warning', function(e) {
                if (!bootstrap || !bootstrap.Toast) return;
                var msg = (e && e.detail && e.detail.message) ? e.detail.message : 'Please complete setup.';

                var toastEl = document.getElementById('flashWarningToast');
                if (!toastEl) {
                    toastEl = document.createElement('div');
                    toastEl.id = 'flashWarningToast';
                    toastEl.className = 'toast align-items-center text-bg-warning border-0 position-fixed top-0 end-0 m-3';
                    toastEl.setAttribute('role', 'alert');
                    toastEl.setAttribute('aria-live', 'assertive');
                    toastEl.setAttribute('aria-atomic', 'true');
                    toastEl.innerHTML = `
                        <div class="d-flex">
                            <div class="toast-body fw-semibold"></div>
                            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    `;
                    document.body.appendChild(toastEl);
                }

                toastEl.querySelector('.toast-body').textContent = msg;
                var toast = bootstrap.Toast.getOrCreateInstance(toastEl, { delay: 3000 });
                toast.show();
            });
        </script>

    </body>
</html>

