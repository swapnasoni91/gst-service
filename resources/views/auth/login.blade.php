<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="mt-2">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
            @error('password')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex align-items-center justify-content-between mb-3">
            <label class="d-flex align-items-center gap-2 mb-0">
                <input id="remember_me" type="checkbox" name="remember" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
                <span class="text-muted" style="font-size:13px;">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-decoration-none small" href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
            @endif
        </div>

        <button class="btn btn-primary w-100" type="submit">
            {{ __('Log in') }}
        </button>

        <div class="text-center mt-3">
            <span class="text-muted" style="font-size:13px;">New here?</span>
            <a class="text-decoration-none" href="{{ route('register') }}">{{ __('Create an account') }}</a>
        </div>
    </form>
</x-guest-layout>

