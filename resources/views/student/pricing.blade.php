<x-app-layout>
    @section('title', 'Upgrade Premium')
    @section('page_title', 'StudySync Premium')

    <div class="row justify-content-center mb-5 mt-3">
        <div class="col-12 text-center mb-4">
            <h2 class="fw-bold text-white mb-2">Tingkatkan Produktivitas Belajar Anda</h2>
            <p class="text-secondary max-w-2xl mx-auto">Dapatkan fitur tak terbatas untuk mengelola tugas dan mata kuliah Anda dengan efisien.</p>
        </div>

        <!-- Pricing Cards -->
        <div class="col-12 col-md-10 col-lg-8">
            <div class="row g-4 justify-content-center">
                <!-- Free Plan -->
                <div class="col-12 col-md-6">
                    <div class="card border-0 rounded-4 shadow-sm h-100 custom-card overflow-hidden position-relative" style="background: rgba(15, 23, 42, 0.5) !important;">
                        @if(!$user->is_premium)
                            <div class="position-absolute top-0 end-0 bg-primary text-white px-3 py-1 rounded-bl-4 small fw-semibold">
                                Plan Aktif
                            </div>
                        @endif
                        <div class="card-body p-4 d-flex flex-column h-100">
                            <div class="mb-4">
                                <h4 class="fw-bold text-white">Basic (Free)</h4>
                                <p class="text-secondary small">Fitur dasar untuk mencoba StudySync</p>
                                <h2 class="fw-extrabold text-white mt-3">IDR 0 <span class="fs-6 fw-normal text-secondary">/ selamanya</span></h2>
                            </div>

                            <hr class="opacity-10 my-3">

                            <ul class="list-unstyled flex-grow-1 text-secondary">
                                <li class="mb-3 d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-primary me-2"></i>
                                    <span>Maksimal 5 Mata Kuliah <strong class="text-white">({{ $subjectsCount }}/5)</strong></span>
                                </li>
                                <li class="mb-3 d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-primary me-2"></i>
                                    <span>Maksimal 5 Tugas <strong class="text-white">({{ $tasksCount }}/5)</strong></span>
                                </li>
                                <li class="mb-3 d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-primary me-2"></i>
                                    <span>Kalender Akademik Standar</span>
                                </li>
                                <li class="mb-3 d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-primary me-2"></i>
                                    <span>Pengingat Otomatis Dasar</span>
                                </li>
                            </ul>

                            <div class="mt-4">
                                @if(!$user->is_premium)
                                    <button class="btn btn-outline-secondary w-100 py-2.5 rounded-3 fw-bold" disabled>
                                        Plan Aktif
                                    </button>
                                @else
                                    <form action="{{ route('student.upgrade.process') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="is_premium" value="0">
                                        <button type="submit" class="btn btn-outline-danger w-100 py-2.5 rounded-3 fw-bold transition">
                                            Downgrade ke Free
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Premium Plan -->
                <div class="col-12 col-md-6">
                    <div class="card border-0 rounded-4 shadow-sm h-100 custom-card overflow-hidden position-relative" style="border: 2px solid #f59e0b !important; background: rgba(15, 23, 42, 0.7) !important;">
                        @if($user->is_premium)
                            <div class="position-absolute top-0 end-0 bg-warning text-dark px-3 py-1 rounded-bl-4 small fw-semibold">
                                Plan Aktif
                            </div>
                        @else
                            <div class="position-absolute top-0 end-0 bg-warning text-dark px-3 py-1 rounded-bl-4 small fw-semibold">
                                Populer
                            </div>
                        @endif
                        <div class="card-body p-4 d-flex flex-column h-100">
                            <div class="mb-4">
                                <h4 class="fw-bold text-warning d-flex align-items-center">
                                    <i class="bi bi-crown-fill me-2"></i>Premium
                                </h4>
                                <p class="text-secondary small">Akses tanpa batas dan fitur eksklusif</p>
                                <h2 class="fw-extrabold text-white mt-3">IDR 19.000 <span class="fs-6 fw-normal text-secondary">/ bulan</span></h2>
                            </div>

                            <hr class="opacity-10 my-3">

                            <ul class="list-unstyled flex-grow-1 text-secondary">
                                <li class="mb-3 d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-warning me-2"></i>
                                    <span class="text-white fw-medium">Mata Kuliah Tanpa Batas (Unlimited)</span>
                                </li>
                                <li class="mb-3 d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-warning me-2"></i>
                                    <span class="text-white fw-medium">Tugas Tanpa Batas (Unlimited)</span>
                                </li>
                                <li class="mb-3 d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-warning me-2"></i>
                                    <span>Statistik Produktivitas Lengkap</span>
                                </li>
                                <li class="mb-3 d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-warning me-2"></i>
                                    <span>Tampilan Kalender & Ekspor Jadwal</span>
                                </li>
                                <li class="mb-3 d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-warning me-2"></i>
                                    <span>Notifikasi Pengingat Custom (Email)</span>
                                </li>
                                <li class="mb-3 d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-warning me-2"></i>
                                    <span>Prioritas Dukungan & Update Fitur</span>
                                </li>
                            </ul>

                            <div class="mt-4">
                                @if($user->is_premium)
                                    <button class="btn btn-warning w-100 py-2.5 rounded-3 fw-bold text-dark d-flex align-items-center justify-content-center" disabled>
                                        <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" class="me-2">
                                            <path d="M5 16L3 5L8.5 10L12 4L15.5 10L21 5L19 16H5M19 19C19 19.6 18.6 20 18 20H6C5.4 20 5 19.6 5 19V18H19V19Z" />
                                        </svg>
                                        <span>Premium Aktif</span>
                                    </button>
                                @else
                                    <form action="{{ route('student.upgrade.process') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="is_premium" value="1">
                                        <button type="submit" class="btn btn-warning w-100 py-2.5 rounded-3 fw-bold text-dark transition shadow d-flex align-items-center justify-content-center" style="background: var(--warning-gradient); border: none;">
                                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" class="me-2">
                                                <path d="M5 16L3 5L8.5 10L12 4L15.5 10L21 5L19 16H5M19 19C19 19.6 18.6 20 18 20H6C5.4 20 5 19.6 5 19V18H19V19Z" />
                                            </svg>
                                            <span>Upgrade Sekarang</span>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
