<x-guest-layout>
    <h4 class="fw-bold text-center text-dark mb-3">Lupa Password?</h4>
    <div class="mb-4 text-secondary text-center small">
        Lupa password? Jangan khawatir. Masukkan alamat email Anda, dan kami akan mengirimkan link reset password yang baru.
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success border-0 shadow-sm mb-4" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="form-label text-secondary fw-medium">Alamat Email</label>
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                <input id="email" class="form-control border-start-0 @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2.5 mb-3 text-white">
            Kirim Link Reset Password
        </button>

        <div class="text-center">
            <a class="text-indigo text-decoration-none small fw-bold" href="{{ route('login') }}"><i class="bi bi-arrow-left me-1"></i> Kembali ke Login</a>
        </div>
    </form>
</x-guest-layout>
