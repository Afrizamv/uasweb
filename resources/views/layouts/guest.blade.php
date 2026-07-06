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
        .text-indigo {
            color: #2563eb !important;
            transition: color 0.2s ease;
        }
        .text-indigo:hover {
            color: #1d4ed8 !important;
        }
        .form-control:focus, .form-select:focus {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15) !important;
        }
    </style>
</head>
<body class="bg-dark d-flex align-items-center justify-content-center min-vh-100" style="background: radial-gradient(circle at 50% 50%, #1e40af 0%, #030712 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
                <div class="text-center mb-4">
                    <h1 class="text-white fw-bold"><i class="bi bi-mortarboard-fill text-blue me-2"></i>StudySync</h1>
                    <p class="text-white-50">Smart Assignment Management</p>
                </div>
                <div class="card border-0 rounded-4 shadow-lg overflow-hidden animate-fade-in-up" style="background-color: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">
                    <div class="card-body p-4 p-md-5">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
