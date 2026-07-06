<x-app-layout>
    @section('title', 'Dashboard Student')
    @section('page_title', 'Dashboard')

    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 rounded-4 bg-gradient-primary text-white p-4 shadow-sm position-relative overflow-hidden">
                <div class="position-absolute end-0 bottom-0 opacity-10" style="font-size: 8rem; transform: translate(20px, 30px);">
                    <i class="bi bi-mortarboard-fill"></i>
                </div>
                <h2 class="fw-bold mb-1">Selamat Datang, {{ auth()->user()->name }}! 👋</h2>
                <p class="mb-0 text-white-50">Kelola tugas kuliah Anda secara cerdas, pantau deadline, dan tingkatkan produktivitas belajar Anda.</p>
            </div>
        </div>
    </div>

    <!-- Stats Cards Row -->
    <div class="row g-3 mb-4">
        <!-- Subjects Count -->
        <div class="col-6 col-lg-4">
            <div class="card custom-card p-3 h-100">
                <div class="d-flex align-items-center">
                    <div class="rounded-3 p-3 bg-primary-subtle text-primary me-3">
                        <i class="bi bi-book-half fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 small fw-semibold">Total Mata Kuliah</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $totalSubjects }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- Total Tasks -->
        <div class="col-6 col-lg-4">
            <div class="card custom-card p-3 h-100">
                <div class="d-flex align-items-center">
                    <div class="rounded-3 p-3 bg-primary-subtle text-primary me-3">
                        <i class="bi bi-list-task fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 small fw-semibold">📋 Total Tugas</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $totalTasks }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- Progress Tasks -->
        <div class="col-6 col-lg-4">
            <div class="card custom-card p-3 h-100">
                <div class="d-flex align-items-center">
                    <div class="rounded-3 p-3 bg-info-subtle text-info me-3">
                        <i class="bi bi-percent fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 small fw-semibold">📊 Progress Tugas</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $progress }}%</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- Belum Dikerjakan -->
        <div class="col-6 col-lg-3">
            <div class="card custom-card p-3 h-100">
                <div class="d-flex align-items-center">
                    <div class="rounded-3 p-3 bg-secondary-subtle text-secondary me-3">
                        <i class="bi bi-hourglass-split fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 small fw-semibold">⏳ Belum Dikerjakan</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $belumDikerjakanTasks }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sedang Dikerjakan -->
        <div class="col-6 col-lg-3">
            <div class="card custom-card p-3 h-100">
                <div class="d-flex align-items-center">
                    <div class="rounded-3 p-3 bg-warning-subtle text-warning me-3">
                        <i class="bi bi-play-circle-fill fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 small fw-semibold">▶ Sedang Dikerjakan</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $sedangDikerjakanTasks }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- Completed Tasks -->
        <div class="col-6 col-lg-3">
            <div class="card custom-card p-3 h-100">
                <div class="d-flex align-items-center">
                    <div class="rounded-3 p-3 bg-success-subtle text-success me-3">
                        <i class="bi bi-check2-circle fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 small fw-semibold">✅ Selesai</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $completedTasks }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- Terlambat -->
        <div class="col-6 col-lg-3">
            <div class="card custom-card p-3 h-100">
                <div class="d-flex align-items-center">
                    <div class="rounded-3 p-3 bg-danger-subtle text-danger me-3">
                        <i class="bi bi-exclamation-octagon-fill fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 small fw-semibold">❌ Terlambat</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $terlambatTasks }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- Deadline Hari Ini -->
        <div class="col-6 col-lg-6">
            <div class="card custom-card p-3 h-100">
                <div class="d-flex align-items-center">
                    <div class="rounded-3 p-3 bg-danger-subtle text-danger me-3">
                        <i class="bi bi-bell-fill fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 small fw-semibold">🔔 Deadline Hari Ini</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $deadlineTodayCount }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- Deadline Besok -->
        <div class="col-6 col-lg-6">
            <div class="card custom-card p-3 h-100">
                <div class="d-flex align-items-center">
                    <div class="rounded-3 p-3 bg-info-subtle text-info me-3">
                        <i class="bi bi-calendar-event fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 small fw-semibold">📅 Deadline Besok</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $deadlineTomorrowCount }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Main Area (Progress & Deadline alerts) -->
        <div class="col-12 col-lg-8">
            <!-- Progress Tracker -->
            <div class="card border-0 rounded-4 p-4 shadow-sm mb-4">
                <h5 class="fw-bold text-dark mb-3"><i class="bi bi-activity text-indigo me-2"></i>Progress Penyelesaian Tugas</h5>
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="fw-medium text-secondary">Tingkat Penyelesaian</span>
                    <span class="fw-bold text-indigo fs-5">{{ $progress }}%</span>
                </div>
                <div class="progress" style="height: 12px; border-radius: 10px;">
                    <div class="progress-bar bg-gradient-primary rounded-pill" role="progressbar" style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

            <!-- Urgent Deadlines Overview -->
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="card border-0 rounded-4 p-4 shadow-sm h-100 bg-warning-subtle border border-warning-subtle text-warning-emphasis">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-exclamation-triangle-fill fs-2 me-3 text-warning"></i>
                            <h5 class="fw-bold mb-0">Deadline Hari Ini</h5>
                        </div>
                        <h2 class="fw-extrabold mb-2">{{ $deadlineTodayCount }}</h2>
                        <p class="mb-0 text-secondary-emphasis small">Tugas mendesak yang harus dikumpulkan hari ini.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 rounded-4 p-4 shadow-sm h-100 bg-primary-subtle border border-primary-subtle text-primary-emphasis">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-calendar-check-fill fs-2 me-3 text-indigo"></i>
                            <h5 class="fw-bold mb-0">Deadline Minggu Ini</h5>
                        </div>
                        <h2 class="fw-extrabold mb-2">{{ $deadlineThisWeekCount }}</h2>
                        <p class="mb-0 text-secondary-emphasis small">Tugas dengan batas waktu dalam 7 hari ke depan.</p>
                    </div>
                </div>
            </div>

            <!-- Quick Navigation Shortcuts -->
            <div class="card border-0 rounded-4 p-4 shadow-sm mt-4">
                <h5 class="fw-bold text-dark mb-3"><i class="bi bi-lightning-fill text-warning me-2"></i>Akses Cepat</h5>
                <div class="row g-2">
                    <div class="col-6 col-sm-3">
                        <a href="{{ route('student.tasks.create') }}" class="btn btn-outline-primary w-100 py-3 rounded-3 d-flex flex-column align-items-center">
                            <i class="bi bi-plus-circle fs-3 mb-2"></i>
                            <span class="small fw-semibold">Tambah Tugas</span>
                        </a>
                    </div>
                    <div class="col-6 col-sm-3">
                        <a href="{{ route('student.subjects.create') }}" class="btn btn-outline-primary w-100 py-3 rounded-3 d-flex flex-column align-items-center">
                            <i class="bi bi-bookmark-plus fs-3 mb-2"></i>
                            <span class="small fw-semibold">Tambah Matkul</span>
                        </a>
                    </div>
                    <div class="col-6 col-sm-3">
                        <a href="{{ route('student.calendar.index') }}" class="btn btn-outline-primary w-100 py-3 rounded-3 d-flex flex-column align-items-center">
                            <i class="bi bi-calendar3 fs-3 mb-2"></i>
                            <span class="small fw-semibold">Kalender Akademik</span>
                        </a>
                    </div>
                    <div class="col-6 col-sm-3">
                        <a href="{{ route('student.statistics.index') }}" class="btn btn-outline-primary w-100 py-3 rounded-3 d-flex flex-column align-items-center">
                            <i class="bi bi-graph-up-arrow fs-3 mb-2"></i>
                            <span class="small fw-semibold">Analisa Statistik</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Area: Reminder list -->
        <div class="col-12 col-lg-4">
            <div class="card border-0 rounded-4 p-4 shadow-sm h-100">
                <h5 class="fw-bold text-dark mb-3"><i class="bi bi-bell-fill text-indigo me-2"></i>Reminder Deadline</h5>
                
                @if(count($remindersList) > 0)
                    <div class="list-group list-group-flush" style="max-height: 480px; overflow-y: auto;">
                        @foreach($remindersList as $rem)
                            <div class="list-group-item px-0 border-0 mb-3 pb-3 border-bottom border-light">
                                <div class="d-flex justify-content-between align-items-start mb-1">
                                    <span class="badge bg-{{ $rem['badge'] }}-subtle text-{{ $rem['badge'] }} border border-{{ $rem['badge'] }}-subtle rounded-pill px-2.5 py-1 small fw-semibold">
                                        {{ $rem['type'] }}
                                    </span>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($rem['task']->deadline)->format('d M Y') }}</small>
                                </div>
                                <h6 class="fw-bold text-dark mb-1 text-truncate">{{ $rem['task']->judul }}</h6>
                                <p class="text-muted small mb-2"><i class="bi bi-journal-bookmark me-1"></i>{{ $rem['task']->subject->nama_mata_kuliah }}</p>
                                <div class="alert alert-{{ $rem['badge'] }} py-2 px-3 mb-0 border-0 rounded-3 small">
                                    <i class="bi bi-info-circle-fill me-1"></i> {{ $rem['message'] }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-emoji-laughing fs-1 text-muted opacity-50 mb-3 d-block"></i>
                        <p class="text-muted small mb-0">Hore! Tidak ada tugas yang mendesak atau terlambat saat ini.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
