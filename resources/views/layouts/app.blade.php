<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'StudySync') - Smart Assignment Management</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar collapse px-0">
                <div class="position-sticky pt-3">
                    <div class="px-4 py-3 mb-4 border-bottom border-secondary border-opacity-25 text-center">
                        <span class="sidebar-brand"><i class="bi bi-mortarboard-fill me-2"></i>StudySync</span>
                    </div>
                    <ul class="nav flex-column">
                        @if(auth()->user()->isStudent())
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('student.dashboard') ? 'active' : '' }}" href="{{ route('student.dashboard') }}">
                                    <i class="bi bi-speedometer2 me-2"></i>Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('student.subjects.*') ? 'active' : '' }}" href="{{ route('student.subjects.index') }}">
                                    <i class="bi bi-book me-2"></i>Mata Kuliah
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('student.tasks.*') ? 'active' : '' }}" href="{{ route('student.tasks.index') }}">
                                    <i class="bi bi-list-task me-2"></i>Tugas
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('student.calendar.*') ? 'active' : '' }}" href="{{ route('student.calendar.index') }}">
                                    <i class="bi bi-calendar-event me-2"></i>Kalender
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('student.statistics.*') ? 'active' : '' }}" href="{{ route('student.statistics.index') }}">
                                    <i class="bi bi-bar-chart-line me-2"></i>Statistik
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('student.reminders.*') ? 'active' : '' }}" href="{{ route('student.reminders.index') }}">
                                    <i class="bi bi-bell me-2"></i>Reminder
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-speedometer2 me-2"></i>Dashboard Admin
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('admin.subjects') ? 'active' : '' }}" href="{{ route('admin.subjects') }}">
                                    <i class="bi bi-book me-2"></i>Mata Kuliah
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('admin.tasks') ? 'active' : '' }}" href="{{ route('admin.tasks') }}">
                                    <i class="bi bi-list-task me-2"></i>Tugas
                                </a>
                            </li>
                        @endif
                        <li class="nav-item border-top border-secondary border-opacity-25 mt-4 pt-3">
                            <a class="nav-link {{ Route::is('profile.edit') ? 'active' : '' }}" href="{{ route('profile.edit') }}">
                                <i class="bi bi-person-fill me-2"></i>Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                @csrf
                                <a class="nav-link text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-2"></i>Keluar
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content Area -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100 d-flex flex-column">
                <!-- Top Navbar -->
                <header class="navbar navbar-light sticky-top bg-white flex-md-nowrap p-0 border-bottom shadow-sm mb-4">
                    <button class="navbar-toggler position-absolute d-md-none collapsed m-2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="w-100 px-4 py-3 d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 text-secondary fw-semibold">@yield('page_title', 'Dashboard')</h4>
                        <div class="d-flex align-items-center">
                            <span class="me-3 d-none d-sm-inline fw-medium text-dark">{{ auth()->user()->name }} <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill small px-2 py-1 ms-1 text-capitalize">{{ auth()->user()->role }}</span></span>
                            @if(auth()->user()->photo)
                                <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="Avatar" class="avatar-img">
                            @else
                                <div class="avatar-img d-flex align-items-center justify-content-center bg-primary-subtle text-primary fw-bold" style="background-color: #dbeafe; color: #2563eb; width: 45px; height: 45px; border-radius: 50%;">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                    </div>
                </header>

                <!-- Page view content -->
                <div class="container-fluid flex-grow-1 animate-fade-in-up">
                    {{ $slot }}
                </div>

                <!-- Footer -->
                <footer class="bg-white text-center text-muted py-3 mt-5 border-top small">
                    <div class="container">
                        <span>&copy; {{ date('Y') }} StudySync – Smart Assignment Management. All rights reserved.</span>
                    </div>
                </footer>
            </main>
        </div>
    </div>

    <!-- Alert notifications using SweetAlert2 -->
    @if(session('success'))
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    confirmButtonColor: '#6366f1'
                });
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: "{{ session('error') }}",
                    confirmButtonColor: '#ef4444'
                });
            });
        </script>
    @endif

    @stack('modals')
    @stack('scripts')
</body>
</html>
