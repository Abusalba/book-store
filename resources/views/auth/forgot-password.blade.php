<x-guest-layout>
    <div class="text-center mb-4">
        <h4 class="fw-bold text-dark">Forgot Password?</h4>
        <p class="text-muted small">No problem. Just let us know your email address and we will email you a password reset link.</p>
    </div>

    @if (session('status'))
    <div class="alert alert-success mb-4">
        {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <div class="input-group">
                <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" required autofocus placeholder="Enter your email address">
            </div>
            @error('email')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex flex-column gap-3">
            <button type="submit" class="btn btn-info w-100">
                {{ __('Email Password Reset Link') }}
            </button>

            <div class="text-center">
                <a href="{{ route('login') }}" class="text-decoration-none">
                    {{ __('Back to Login') }}
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>