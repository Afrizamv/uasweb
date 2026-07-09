<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'StudySync') }}</title>
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
            transform: translateY(-1px) !important;
        }
        .text-blue {
            color: #38bdf8 !important;
        }
        .text-indigo {
            color: #38bdf8 !important;
            transition: all 0.2s ease;
        }
        .text-indigo:hover {
            color: #7c3aed !important;
        }
        .form-control:focus, .form-select:focus {
            border-color: #38bdf8 !important;
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.2) !important;
        }
        .card {
            background: rgba(15, 23, 42, 0.7) !important;
            border: 1px solid rgba(99, 102, 241, 0.25) !important;
            backdrop-filter: blur(16px) !important;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5), 0 0 35px rgba(56, 189, 248, 0.08) !important;
        }
        .card h3, .card h2, .card h4, .card h5 {
            color: #ffffff !important;
            background: linear-gradient(135deg, #ffffff 0%, #d1d5db 100%) !important;
            -webkit-background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
        }
        .card label, .card .text-secondary {
            color: rgba(255, 255, 255, 0.6) !important;
        }
        .input-group-text {
            background-color: rgba(15, 23, 42, 0.65) !important;
            border-color: rgba(255, 255, 255, 0.15) !important;
            color: rgba(255, 255, 255, 0.5) !important;
        }
        .form-control {
            background-color: rgba(15, 23, 42, 0.65) !important;
            border-color: rgba(255, 255, 255, 0.15) !important;
            color: #ffffff !important;
        }
        .form-control:focus {
            background-color: rgba(15, 23, 42, 0.8) !important;
            color: #ffffff !important;
        }
        .form-check-input {
            background-color: rgba(15, 23, 42, 0.6) !important;
            border-color: rgba(255, 255, 255, 0.15) !important;
        }
        .form-check-input:checked {
            background-color: #0ea5e9 !important;
            border-color: #0ea5e9 !important;
        }
        /* Custom glowing background orbs */
        @keyframes pulse-glow {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 0.8; }
        }
        .glowing-orb {
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            z-index: -1;
            pointer-events: none;
            animation: pulse-glow 8s infinite ease-in-out;
            filter: blur(80px);
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100" style="background: radial-gradient(circle at 50% 50%, #0f172a 0%, #030712 100%); position: relative; overflow: hidden;">
    <!-- Glowing background orbs -->
    <div class="glowing-orb" style="top: -150px; left: -150px; background: radial-gradient(circle, rgba(14, 165, 233, 0.12) 0%, rgba(0, 0, 0, 0) 70%);"></div>
    <div class="glowing-orb" style="bottom: -150px; right: -150px; background: radial-gradient(circle, rgba(124, 58, 237, 0.1) 0%, rgba(0, 0, 0, 0) 70%);"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
                <div class="text-center mb-4">
                    <h1 class="text-white fw-bold"><i class="bi bi-book-half text-blue me-2"></i>StudySync</h1>
                    <p class="text-white-50">Smart Assignment Management</p>
                </div>
                <div class="card border-0 rounded-4 shadow-lg overflow-hidden animate-fade-in-up">
                    <div class="card-body p-4 p-md-5">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
