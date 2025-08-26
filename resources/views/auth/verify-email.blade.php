<x-guest-layout>
    <div class="text-center mb-4">
        <h4 class="fw-bold text-dark">Verify Your Email</h4>
        <p class="text-muted small">Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?</p>
    </div>

    @if (session('status') == 'verification-link-sent')
    <div class="alert alert-success mb-4">
        <i class="fas fa-check-circle me-2"></i>
        A new verification link has been sent to the email address you provided during registration.
    </div>
    @endif

    <div class="d-flex flex-column gap-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary w-100">
                {{ __('Resend Verification Email') }}
            </button>
        </form>

        <div class="text-center">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-link text-decoration-none p-0">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>