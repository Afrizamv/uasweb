<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>StudySync – Smart Assignment Management</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }
        .btn-primary {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%) !important;
            border: none !important;
            box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2) !important;
            transition: all 0.2s ease !important;
        }
        .btn-primary:hover, .btn-primary:focus {
            background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%) !important;
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3) !important;
            transform: translateY(-1px) !important;
        }
        .text-blue {
            color: #60a5fa !important;
        }
        .bg-blue-opacity {
            background-color: rgba(96, 165, 250, 0.1) !important;
        }
    </style>
</head>
<body style="background: radial-gradient(circle at 80% 20%, #1e40af 0%, #030712 100%); color: #ffffff; min-height: 100vh; overflow-x: hidden;">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent py-4">
        <div class="container">
            <a class="navbar-brand fw-extrabold fs-3 text-white" href="/">
                <i class="bi bi-mortarboard-fill text-blue me-2"></i>StudySync
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <div class="d-flex gap-3 mt-3 mt-lg-0">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-primary text-white px-4 py-2 rounded-pill fw-semibold">Dashboard <i class="bi bi-arrow-right ms-1"></i></a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-light px-4 py-2 rounded-pill fw-semibold">Masuk</a>
                        <a href="{{ route('register') }}" class="btn btn-primary text-white px-4 py-2 rounded-pill fw-semibold shadow">Daftar Gratis</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="py-5 my-md-5">
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-12 col-lg-6 text-center text-lg-start animate-fade-in-up">
                    <h1 class="display-3 fw-extrabold text-white mb-3" style="line-height: 1.15; letter-spacing: -1.5px;">
                        Kelola Tugas Kuliah <span class="text-primary" style="background: linear-gradient(to right, #93c5fd, #3b82f6); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Lebih Cerdas & Cepat</span>
                    </h1>
                    <p class="lead text-white-50 mb-4 fw-normal">
                        StudySync membantu mahasiswa dari berbagai universitas mengatur tugas kuliah, melacak jadwal ujian/presentasi, menganalisis statistik studi, dan mendapatkan pengingat deadline otomatis secara real-time.
                    </p>
                    <div class="d-flex flex-column flex-sm-row justify-content-center justify-content-lg-start gap-3">
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg px-4 py-3 rounded-3 text-white fw-bold shadow-lg">
                                Kembali ke Dashboard <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-4 py-3 rounded-3 text-white fw-bold shadow-lg">
                                Mulai Sekarang – Gratis <i class="bi bi-rocket-takeoff-fill ms-2"></i>
                            </a>
                            <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-4 py-3 rounded-3 fw-semibold">
                                Masuk ke Akun
                            </a>
                        @endauth
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <!-- Feature Preview Board Mockup -->
                    <div class="card border-0 rounded-4 shadow-lg p-3 animate-fade-in-up" style="background-color: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1) !important; backdrop-filter: blur(10px);">
                        <div class="d-flex gap-2 border-bottom border-secondary border-opacity-25 pb-3 mb-3">
                            <span class="rounded-circle bg-danger d-inline-block" style="width: 12px; height: 12px;"></span>
                            <span class="rounded-circle bg-warning d-inline-block" style="width: 12px; height: 12px;"></span>
                            <span class="rounded-circle bg-success d-inline-block" style="width: 12px; height: 12px;"></span>
                        </div>
                        <div class="text-start">
                            <h5 class="fw-bold mb-1"><i class="bi bi-bell-fill text-warning me-2"></i>Deadline Reminder Aktif</h5>
                            <p class="text-white-50 small">Sistem SaaS kami mendeteksi deadline otomatis untuk Anda:</p>
                            <div class="list-group list-group-flush gap-2">
                                <div class="list-group-item bg-transparent text-white border-0 p-2.5 rounded-3" style="background-color: rgba(239, 68, 68, 0.15) !important;">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <strong class="small text-danger"><i class="bi bi-exclamation-octagon-fill me-1"></i>Sudah Lewat</strong>
                                        <span class="text-muted small">Kemarin</span>
                                    </div>
                                    <span class="small fw-semibold d-block">Laporan Praktikum: Transversal Binary Tree</span>
                                </div>
                                <div class="list-group-item bg-transparent text-white border-0 p-2.5 rounded-3" style="background-color: rgba(245, 158, 11, 0.15) !important;">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <strong class="small text-warning"><i class="bi bi-exclamation-triangle-fill me-1"></i>Hari Ini (Urgent)</strong>
                                        <span class="text-muted small">Hari Ini 23:59</span>
                                    </div>
                                    <span class="small fw-semibold d-block">Tugas Pemrograman: Setup Laravel 12 CRUD</span>
                                </div>
                                <div class="list-group-item bg-transparent text-white border-0 p-2.5 rounded-3" style="background-color: rgba(16, 185, 129, 0.15) !important;">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <strong class="small text-success"><i class="bi bi-clock-history me-1"></i>Besok</strong>
                                        <span class="text-muted small">Besok 10:00</span>
                                    </div>
                                    <span class="small fw-semibold d-block">Kuis AI: Algoritma BFS & DFS</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Feature Grid Section -->
    <section class="py-5" style="background-color: rgba(0,0,0,0.2);">
        <div class="container py-5 text-center">
            <h2 class="fw-bold mb-5">Fitur Cerdas Unggulan</h2>
            <div class="row g-4">
                <div class="col-12 col-md-4">
                    <div class="card bg-transparent border-0 text-center p-4">
                        <div class="rounded-circle p-4 bg-blue-opacity text-blue d-inline-flex mx-auto mb-4" style="width: 80px; height: 80px; align-items: center; justify-content: center;">
                            <i class="bi bi-shield-check fs-2"></i>
                        </div>
                        <h5 class="fw-bold text-white mb-2">Pemisahan Data SaaS</h5>
                        <p class="text-white-50 small">Setiap mahasiswa memiliki akun dan ruang kerja terisolasi. Data Anda dijamin aman dan terpisah dari pengguna lain.</p>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card bg-transparent border-0 text-center p-4">
                        <div class="rounded-circle p-4 bg-blue-opacity text-blue d-inline-flex mx-auto mb-4" style="width: 80px; height: 80px; align-items: center; justify-content: center;">
                            <i class="bi bi-calendar-event fs-2"></i>
                        </div>
                        <h5 class="fw-bold text-white mb-2">Kalender Deadline Visual</h5>
                        <p class="text-white-50 small">Integrasi FullCalendar memudahkan Anda melihat rentang waktu tugas secara dinamis. Klik tugas untuk info mendetail.</p>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card bg-transparent border-0 text-center p-4">
                        <div class="rounded-circle p-4 bg-blue-opacity text-blue d-inline-flex mx-auto mb-4" style="width: 80px; height: 80px; align-items: center; justify-content: center;">
                            <i class="bi bi-pie-chart fs-2"></i>
                        </div>
                        <h5 class="fw-bold text-white mb-2">Analisa Belajar Chart.js</h5>
                        <p class="text-white-50 small">Visualisasikan kemajuan belajar Anda, statistik status tugas selesai vs tertunda, serta densitas pengerjaan tugas bulanan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-4 text-center text-white-50 border-top border-secondary border-opacity-25 mt-5">
        <div class="container small">
            <span>&copy; {{ date('Y') }} StudySync – Smart Assignment Management (SaaS Laravel 12).</span>
        </div>
    </footer>

</body>
</html>
