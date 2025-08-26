<x-guest-layout>
    <div class="text-center mb-4">
        <h4 class="fw-bold text-dark">My Book Store</h4>
        <p class="text-muted">Sign in to your account</p>
    </div>

    @if (session('status'))
    <div class="alert alert-success mb-4">
        {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <div class="input-group">
                <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Enter your email">
            </div>
            @error('email')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <div class="input-group">
                <input id="password" type="password" name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    required autocomplete="current-password" placeholder="Enter your password">
            </div>
            @error('password')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
            <label class="form-check-label" for="remember_me">
                {{ __('Remember me') }}
            </label>
        </div>

        <div class="d-flex flex-column gap-3">
            <button type="submit" class="btn btn-info w-100">
                <i class="fas fa-sign-in-alt me-2"></i>{{ __('Log in') }}
            </button>

            <div class="text-center">
                @if (Route::has('password.request'))
                <a class="text-decoration-none" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif
            </div>

            <div class="text-center">
                <span class="text-muted">Don't have an account?</span>
                <a href="{{ route('register') }}" class="text-decoration-none">{{ __('Sign up') }}</a>
            </div>
        </div>
    </form>
</x-guest-layout>