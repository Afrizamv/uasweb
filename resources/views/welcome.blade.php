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
            background: linear-gradient(135deg, #0ea5e9 0%, #7c3aed 100%) !important;
            border: none !important;
            box-shadow: 0 4px 14px 0 rgba(124, 58, 237, 0.3) !important;
            transition: all 0.3s ease !important;
        }
        .btn-primary:hover, .btn-primary:focus {
            background: linear-gradient(135deg, #38bdf8 0%, #8b5cf6 100%) !important;
            box-shadow: 0 6px 20px 0 rgba(124, 58, 237, 0.5) !important;
            transform: translateY(-2px) !important;
        }
        .btn-outline-light {
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            transition: all 0.3s ease !important;
        }
        .btn-outline-light:hover {
            background: rgba(255, 255, 255, 0.08) !important;
            border-color: rgba(255, 255, 255, 0.5) !important;
            transform: translateY(-2px) !important;
        }
        .text-blue {
            color: #38bdf8 !important;
        }
        .bg-blue-opacity {
            background-color: rgba(56, 189, 248, 0.1) !important;
            border: 1px solid rgba(56, 189, 248, 0.2) !important;
        }
        .text-glow-gradient {
            background: linear-gradient(135deg, #38bdf8 0%, #a855f7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        /* Custom animations and background orbs */
        @keyframes pulse-glow {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 0.8; }
        }
        .glowing-orb {
            position: absolute;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            z-index: -1;
            pointer-events: none;
            animation: pulse-glow 8s infinite ease-in-out;
            filter: blur(80px);
        }
    </style>
</head>
<body style="background: radial-gradient(circle at 50% 50%, #0f172a 0%, #030712 100%); color: #ffffff; min-height: 100vh; overflow-x: hidden; position: relative;">
    <!-- Background glowing orbs -->
    <div class="glowing-orb" style="top: -150px; right: -150px; background: radial-gradient(circle, rgba(14, 165, 233, 0.15) 0%, rgba(0, 0, 0, 0) 70%);"></div>
    <div class="glowing-orb" style="bottom: 10%; left: -250px; background: radial-gradient(circle, rgba(124, 58, 237, 0.12) 0%, rgba(0, 0, 0, 0) 70%);"></div>

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
                        Kelola Tugas Kuliah <span class="text-glow-gradient">Lebih Cerdas & Cepat</span>
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
                    <div class="card border-0 rounded-4 shadow-lg p-3 animate-fade-in-up" style="background: rgba(15, 23, 42, 0.65) !important; border: 1px solid rgba(99, 102, 241, 0.25) !important; backdrop-filter: blur(12px); box-shadow: 0 20px 40px rgba(0,0,0,0.5), 0 0 30px rgba(56, 189, 248, 0.08) !important;">
                        <div class="d-flex gap-2 border-bottom border-secondary border-opacity-25 pb-3 mb-3">
                            <span class="rounded-circle bg-danger d-inline-block" style="width: 12px; height: 12px;"></span>
                            <span class="rounded-circle bg-warning d-inline-block" style="width: 12px; height: 12px;"></span>
                            <span class="rounded-circle bg-success d-inline-block" style="width: 12px; height: 12px;"></span>
                        </div>
                        <div class="text-start">
                            <h5 class="fw-bold mb-1"><i class="bi bi-bell-fill text-warning me-2"></i>Deadline Reminder Aktif</h5>
                            <p class="text-white-50 small">Sistem SaaS kami mendeteksi deadline otomatis untuk Anda:</p>
                            <div class="list-group list-group-flush gap-2">
                                <div class="list-group-item bg-transparent text-white border-0 p-2.5 rounded-3" style="background-color: rgba(239, 68, 68, 0.12) !important; border: 1px solid rgba(239, 68, 68, 0.2) !important;">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <strong class="small text-danger"><i class="bi bi-exclamation-octagon-fill me-1"></i>Sudah Lewat</strong>
                                        <span class="text-muted small">Kemarin</span>
                                    </div>
                                    <span class="small fw-semibold d-block">Laporan Praktikum: Transversal Binary Tree</span>
                                </div>
                                <div class="list-group-item bg-transparent text-white border-0 p-2.5 rounded-3" style="background-color: rgba(245, 158, 11, 0.12) !important; border: 1px solid rgba(245, 158, 11, 0.2) !important;">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <strong class="small text-warning"><i class="bi bi-exclamation-triangle-fill me-1"></i>Hari Ini (Urgent)</strong>
                                        <span class="text-muted small">Hari Ini 23:59</span>
                                    </div>
                                    <span class="small fw-semibold d-block">Tugas Pemrograman: Setup Laravel 12 CRUD</span>
                                </div>
                                <div class="list-group-item bg-transparent text-white border-0 p-2.5 rounded-3" style="background-color: rgba(16, 185, 129, 0.12) !important; border: 1px solid rgba(16, 185, 129, 0.2) !important;">
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
    <section class="py-5" style="background: linear-gradient(180deg, rgba(3, 7, 18, 0) 0%, rgba(15, 23, 42, 0.4) 100%); border-top: 1px solid rgba(255,255,255,0.03);">
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
