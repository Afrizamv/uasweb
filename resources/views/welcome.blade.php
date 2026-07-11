<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>StudySync – Smart Assignment Management</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            background: #000000 !important;
            color: #ffffff !important;
            position: relative;
        }
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: url('{{ asset('images/landing_bg.png') }}') no-repeat center center / cover;
            opacity: 0.08;
            z-index: -2;
            pointer-events: none;
        }
        .btn-primary {
            background: #000000 !important;
            border: 1px solid #ffffff !important;
            color: #ffffff !important;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1) !important;
            transition: all 0.3s ease !important;
        }
        .btn-primary:hover, .btn-primary:focus {
            background: #ffffff !important;
            color: #000000 !important;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.3) !important;
            transform: translateY(-2px) !important;
        }
        .btn-outline-light {
            border: 1px solid rgba(255, 255, 255, 0.3) !important;
            color: #ffffff !important;
            background: #000000 !important;
            transition: all 0.3s ease !important;
        }
        .btn-outline-light:hover {
            background: rgba(255, 255, 255, 0.1) !important;
            border-color: #ffffff !important;
            color: #ffffff !important;
            transform: translateY(-2px) !important;
        }
        .text-blue {
            color: #ffffff !important;
        }
        .bg-blue-opacity {
            background-color: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.15) !important;
        }
        .text-glow-gradient {
            background: linear-gradient(135deg, #ffffff 0%, #a1a1aa 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        /* Glassmorphic cards for featured section to reveal the background watermark */
        .features-section .card {
            background-color: rgba(255, 255, 255, 0.03) !important;
            backdrop-filter: blur(12px) !important;
            -webkit-backdrop-filter: blur(12px) !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            border-radius: 16px !important;
            transition: all 0.3s ease !important;
        }
        .features-section .card:hover {
            background-color: rgba(255, 255, 255, 0.06) !important;
            border-color: rgba(255, 255, 255, 0.15) !important;
            transform: translateY(-5px) !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5) !important;
        }
    </style>
</head>
<body style="background: #000000 !important; color: #ffffff !important; min-height: 100vh; overflow-x: hidden; position: relative;">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent py-4">
        <div class="container">
            <a class="navbar-brand fw-extrabold fs-3 text-blue d-flex align-items-center" href="/">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="me-2 rounded-circle" style="width: 32px; height: 32px; object-fit: cover;">
                StudySync
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <div class="d-flex gap-3 mt-3 mt-lg-0">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-primary px-4 py-2 rounded-pill fw-semibold">Dashboard <i class="bi bi-arrow-right ms-1"></i></a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-light px-4 py-2 rounded-pill fw-semibold">Masuk</a>
                        <a href="{{ route('register') }}" class="btn btn-primary px-4 py-2 rounded-pill fw-semibold shadow">Daftar Gratis</a>
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
                    <h1 class="display-3 fw-extrabold mb-3" style="line-height: 1.15; letter-spacing: -1.5px; color: #ffffff !important;">
                        Asisten Cerdas <span class="text-glow-gradient">Manajemen Tugas Kuliah Anda</span>
                    </h1>
                    <p class="lead mb-4 fw-normal" style="color: #a1a1aa !important;">
                        StudySync membantu mahasiswa mengelola mata kuliah, mencatat tugas kuliah beserta lampiran berkas, memantau tenggat waktu di kalender interaktif, serta menganalisis progress belajar secara real-time.
                    </p>
                    <div class="d-flex flex-column flex-sm-row justify-content-center justify-content-lg-start gap-3">
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg px-4 py-3 rounded-3 fw-bold shadow-lg">
                                Kembali ke Dashboard <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-4 py-3 rounded-3 fw-bold shadow-lg">
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
                    <div class="card border-0 rounded-4 shadow-lg p-3 animate-fade-in-up" style="background: #000000 !important; border: 1px solid rgba(255, 255, 255, 0.15) !important; box-shadow: 0 0 25px rgba(255, 255, 255, 0.05) !important;">
                        <div class="d-flex gap-2 border-bottom border-secondary border-opacity-25 pb-3 mb-3">
                            <span class="rounded-circle bg-danger d-inline-block" style="width: 12px; height: 12px;"></span>
                            <span class="rounded-circle bg-warning d-inline-block" style="width: 12px; height: 12px;"></span>
                            <span class="rounded-circle bg-success d-inline-block" style="width: 12px; height: 12px;"></span>
                        </div>
                        <div class="text-start">
                            <h5 class="fw-bold mb-1" style="color: #ffffff !important;"><i class="bi bi-bell-fill text-warning me-2"></i>Deadline Reminder Aktif</h5>
                            <p class="small" style="color: #a1a1aa !important;">Sistem SaaS kami mendeteksi deadline otomatis untuk Anda:</p>
                            <div class="list-group list-group-flush gap-2">
                                <div class="list-group-item bg-transparent border-0 p-2.5 rounded-3" style="background-color: rgba(239, 68, 68, 0.12) !important; border: 1px solid rgba(239, 68, 68, 0.2) !important; color: #ffffff !important;">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <strong class="small text-danger"><i class="bi bi-exclamation-octagon-fill me-1"></i>Sudah Lewat</strong>
                                        <span class="text-muted small" style="color: #a1a1aa !important;">Kemarin</span>
                                    </div>
                                    <span class="small fw-semibold d-block">Laporan Praktikum: Transversal Binary Tree</span>
                                </div>
                                <div class="list-group-item bg-transparent border-0 p-2.5 rounded-3" style="background-color: rgba(245, 158, 11, 0.12) !important; border: 1px solid rgba(245, 158, 11, 0.2) !important; color: #ffffff !important;">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <strong class="small text-warning"><i class="bi bi-exclamation-triangle-fill me-1"></i>Hari Ini (Urgent)</strong>
                                        <span class="text-muted small" style="color: #a1a1aa !important;">Hari Ini 23:59</span>
                                    </div>
                                    <span class="small fw-semibold d-block">Tugas Pemrograman: Setup Laravel 12 CRUD</span>
                                </div>
                                <div class="list-group-item bg-transparent border-0 p-2.5 rounded-3" style="background-color: rgba(16, 185, 129, 0.12) !important; border: 1px solid rgba(16, 185, 129, 0.2) !important; color: #ffffff !important;">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <strong class="small text-success"><i class="bi bi-clock-history me-1"></i>Besok</strong>
                                        <span class="text-muted small" style="color: #a1a1aa !important;">Besok 10:00</span>
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
    <section class="py-5 features-section" style="background: transparent !important; border-top: 1px solid rgba(255, 255, 255, 0.1) !important;">
        <div class="container py-5 text-center">
            <h2 class="fw-bold mb-5" style="color: #ffffff !important;">Fitur Cerdas Unggulan</h2>
            <div class="row g-4">
                <div class="col-12 col-md-4">
                    <div class="card bg-transparent border-0 text-center p-4">
                        <div class="rounded-circle p-4 bg-blue-opacity text-blue d-inline-flex mx-auto mb-4" style="width: 80px; height: 80px; align-items: center; justify-content: center;">
                            <i class="bi bi-list-task fs-2"></i>
                        </div>
                        <h5 class="fw-bold mb-2" style="color: #ffffff !important;">Manajemen Tugas & Kuota</h5>
                        <p class="small" style="color: #a1a1aa !important;">Kelola seluruh mata kuliah dan tugas kuliah Anda secara terstruktur. Akun Free mendukung kuota pembuatan hingga 5 mata kuliah.</p>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card bg-transparent border-0 text-center p-4">
                        <div class="rounded-circle p-4 bg-blue-opacity text-blue d-inline-flex mx-auto mb-4" style="width: 80px; height: 80px; align-items: center; justify-content: center;">
                            <svg viewBox="0 0 24 24" width="28" height="28" fill="currentColor">
                                <path d="M5 16L3 5L8.5 10L12 4L15.5 10L21 5L19 16H5M19 19C19 19.6 18.6 20 18 20H6C5.4 20 5 19.6 5 19V18H19V19Z" />
                            </svg>
                        </div>
                        <h5 class="fw-bold mb-2" style="color: #ffffff !important;">Upgrade Premium Instan</h5>
                        <p class="small" style="color: #a1a1aa !important;">Buka kuota tanpa batas untuk membuat mata kuliah dan tugas sepuasnya, lengkap dengan badge mahkota Premium eksklusif pada akun Anda.</p>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card bg-transparent border-0 text-center p-4">
                        <div class="rounded-circle p-4 bg-blue-opacity text-blue d-inline-flex mx-auto mb-4" style="width: 80px; height: 80px; align-items: center; justify-content: center;">
                            <i class="bi bi-calendar-check fs-2"></i>
                        </div>
                        <h5 class="fw-bold mb-2" style="color: #ffffff !important;">Kalender & Pengingat</h5>
                        <p class="small" style="color: #a1a1aa !important;">Pantau semua deadline tugas secara visual melalui kalender interaktif dan dapatkan peringatan otomatis untuk tugas yang mendekati batas waktu.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-4 text-center border-top mt-5" style="background: #000000 !important; border-top: 1px solid rgba(255, 255, 255, 0.1) !important; color: #a1a1aa !important;">
        <div class="container small">
            <span>&copy; {{ date('Y') }} StudySync – Smart Assignment Management (SaaS).</span>
        </div>
    </footer>

</body>
</html>
