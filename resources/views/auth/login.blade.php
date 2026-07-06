<x-guest-layout>
    <h3 class="fw-bold text-center text-dark mb-4">Masuk ke Akun</h3>

    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success border-0 shadow-sm mb-4" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label text-secondary fw-medium">Alamat Email</label>
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                <input id="email" class="form-control border-start-0 @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Password -->
        <div class="mb-3">
            <div class="d-flex justify-content-between align-items-center mb-1">
                <label for="password" class="form-label text-secondary fw-medium mb-0">Password</label>
                @if (Route::has('password.request'))
                    <a class="text-indigo text-decoration-none small" href="{{ route('password.request') }}">
                        Lupa Password?
                    </a>
                @endif
            </div>
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-shield-lock"></i></span>
                <input id="password" class="form-control border-start-0 @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="current-password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Remember Me -->
        <div class="form-check mb-4">
            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
            <label for="remember_me" class="form-check-label text-secondary small">Ingat saya di perangkat ini</label>
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2.5 mb-3 text-white">
            Masuk
        </button>

        <div class="text-center">
            <span class="text-secondary small">Belum punya akun? <a class="text-indigo text-decoration-none fw-bold" href="{{ route('register') }}">Daftar</a></span>
        </div>
    </form>
</x-guest-layout>
