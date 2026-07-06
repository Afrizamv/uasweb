<x-app-layout>
    @section('title', 'Profil Pengguna')
    @section('page_title', 'Pengaturan Profil')

    <div class="row g-4">
        <!-- Left Column: Profile Picture & Personal Info -->
        <div class="col-12 col-lg-6">
            <div class="card border-0 rounded-4 shadow-sm p-4 h-100">
                <h5 class="fw-bold text-dark mb-4"><i class="bi bi-person-fill text-indigo me-2"></i>Informasi Profil</h5>
                
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    <!-- Photo Upload -->
                    <div class="text-center mb-4">
                        @if($user->photo)
                            <img src="{{ asset('storage/' . $user->photo) }}" alt="Foto Profil" class="rounded-circle shadow-sm border border-3 border-indigo-subtle mb-3" style="width: 130px; height: 130px; object-fit: cover;">
                        @else
                            <div class="rounded-circle bg-indigo-subtle text-indigo fw-bold d-inline-flex align-items-center justify-content-center shadow-sm mb-3" style="width: 130px; height: 130px; font-size: 3.5rem; background-color: #e0e7ff; color: #4338ca;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif

                        <div class="mx-auto" style="max-width: 320px;">
                            <label for="photo" class="form-label text-secondary fw-semibold small">Ganti Foto Profil</label>
                            <input type="file" name="photo" id="photo" class="form-control form-control-sm @error('photo') is-invalid @enderror">
                            <span class="text-muted small d-block mt-1">JPEG, JPG, atau PNG (Maks. 2 MB)</span>
                            @error('photo')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label text-secondary fw-semibold">Nama Lengkap</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="form-label text-secondary fw-semibold">Alamat Email</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary text-white w-100">Simpan Perubahan Profil</button>
                </form>
            </div>
        </div>

        <!-- Right Column: Change Password & Delete Account -->
        <div class="col-12 col-lg-6">
            <!-- Change Password Card -->
            <div class="card border-0 rounded-4 shadow-sm p-4 mb-4">
                <h5 class="fw-bold text-dark mb-4"><i class="bi bi-shield-lock-fill text-indigo me-2"></i>Ubah Password</h5>
                
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <!-- Current Password -->
                    <div class="mb-3">
                        <label for="update_password_current_password" class="form-label text-secondary fw-semibold">Password Saat Ini</label>
                        <input type="password" name="current_password" id="update_password_current_password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" required>
                        @error('current_password', 'updatePassword')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- New Password -->
                    <div class="mb-3">
                        <label for="update_password_password" class="form-label text-secondary fw-semibold">Password Baru (Min. 8 karakter)</label>
                        <input type="password" name="password" id="update_password_password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" required>
                        @error('password', 'updatePassword')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label for="update_password_password_confirmation" class="form-label text-secondary fw-semibold">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" id="update_password_password_confirmation" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" required>
                        @error('password_confirmation', 'updatePassword')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary text-white w-100">Ubah Password</button>
                </form>
            </div>

            <!-- Delete Account Card -->
            <div class="card border-0 rounded-4 shadow-sm p-4 bg-danger-subtle border border-danger-subtle">
                <h5 class="fw-bold text-danger mb-3"><i class="bi bi-exclamation-triangle-fill me-2"></i>Zona Bahaya</h5>
                <p class="text-danger-emphasis small mb-4">
                    Setelah akun Anda dihapus, semua data seperti mata kuliah, tugas, reminder, dan file lampiran akan dihapus secara permanen dari server. Tindakan ini tidak dapat dibatalkan.
                </p>
                
                <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                    Hapus Akun Saya
                </button>
            </div>
        </div>
    </div>

    @push('modals')
    <!-- Delete Account Confirmation Modal -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-dark" id="deleteAccountModalLabel">Konfirmasi Penghapusan Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')
                    
                    <div class="modal-body py-4">
                        <p class="text-secondary small">
                            Apakah Anda yakin ingin menghapus akun? Masukkan password Anda untuk memverifikasi penghapusan akun secara permanen.
                        </p>
                        <div class="mb-3">
                            <label for="delete_password" class="form-label text-secondary fw-semibold">Password Verifikasi</label>
                            <input type="password" name="password" id="delete_password" class="form-control @error('password', 'userDeletion') is-invalid @enderror" placeholder="Masukkan password Anda..." required>
                            @error('password', 'userDeletion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-outline-secondary text-dark" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus Akun Permanen</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endpush
</x-app-layout>
