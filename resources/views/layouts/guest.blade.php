<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'StudySync') }}</title>
    <link class="brand-favicon" rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            background: #000000 !important;
            color: #ffffff !important;
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
            transform: translateY(-1px) !important;
        }
        .text-blue {
            color: #ffffff !important;
        }
        .text-indigo {
            color: #ffffff !important;
            transition: all 0.2s ease;
        }
        .text-indigo:hover {
            color: #e4e4e7 !important;
        }
        .form-control:focus, .form-select:focus {
            border-color: #ffffff !important;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.2) !important;
        }
        .card {
            background: #000000 !important;
            border: 1px solid rgba(255, 255, 255, 0.15) !important;
            backdrop-filter: blur(16px) !important;
            box-shadow: 0 0 25px rgba(255, 255, 255, 0.05) !important;
        }
        .card h3, .card h2, .card h4, .card h5 {
            color: #ffffff !important;
            background: linear-gradient(135deg, #ffffff 0%, #a1a1aa 100%) !important;
            -webkit-background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
        }
        .card label, .card .text-secondary {
            color: #a1a1aa !important;
        }
        .input-group-text {
            background-color: #000000 !important;
            border-color: rgba(255, 255, 255, 0.15) !important;
            color: #ffffff !important;
        }
        .form-control {
            background-color: #000000 !important;
            border-color: rgba(255, 255, 255, 0.15) !important;
            color: #ffffff !important;
        }
        .form-control:focus {
            background-color: #050505 !important;
            color: #ffffff !important;
        }
        .form-check-input {
            background-color: #000000 !important;
            border-color: rgba(255, 255, 255, 0.15) !important;
        }
        .form-check-input:checked {
            background-color: #ffffff !important;
            border-color: #ffffff !important;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100" style="background: #000000 !important; position: relative; overflow: hidden;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
                <div class="text-center mb-4">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="mb-3 rounded-circle" style="width: 64px; height: 64px; object-fit: cover; border: 2px solid rgba(255, 255, 255, 0.15);">
                    <h1 class="fw-bold mb-0" style="color: #ffffff !important;">StudySync</h1>
                    <p style="color: #a1a1aa !important;">Smart Assignment Management</p>
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
