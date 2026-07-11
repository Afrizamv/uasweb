<x-app-layout>
    @section('title', 'Admin Dashboard')
    @section('page_title', 'Dashboard Admin')

    <!-- Admin Welcome -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 rounded-4 bg-gradient-primary text-dark p-4 shadow-sm position-relative overflow-hidden">
                <div class="position-absolute end-0 bottom-0" style="font-size: 8rem; transform: translate(20px, 30px); opacity: 0.25; pointer-events: none;">
                    <i class="bi bi-key-fill text-dark"></i>
                </div>
                <h2 class="fw-bold mb-1 text-dark">Admin</h2>
                <p class="mb-0 text-dark opacity-75 pe-5" style="max-width: 80%;">Kelola data mahasiswa dan tugas.</p>
            </div>
        </div>
    </div>

    <!-- Admin Stats -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-md-4">
            <div class="card custom-card p-3 h-100">
                <div class="d-flex align-items-center">
                    <div class="rounded-3 p-3 bg-primary-subtle text-primary me-3">
                        <i class="bi bi-people-fill fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 small fw-semibold">Total Mahasiswa</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $totalStudents }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card custom-card p-3 h-100">
                <div class="d-flex align-items-center">
                    <div class="rounded-3 p-3 bg-success-subtle text-success me-3">
                        <i class="bi bi-journals fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 small fw-semibold">Total Mata Kuliah</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $totalSubjects }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card custom-card p-3 h-100">
                <div class="d-flex align-items-center">
                    <div class="rounded-3 p-3 bg-info-subtle text-info me-3">
                        <i class="bi bi-card-checklist fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 small fw-semibold">Total Tugas Kuliah</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $totalTasks }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Students Management Table -->
    <div class="card border-0 rounded-4 shadow-sm p-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
            <h5 class="fw-bold text-dark mb-3 mb-md-0"><i class="bi bi-person-lines-fill text-indigo me-2"></i>Daftar Mahasiswa Terdaftar</h5>
            
            <form action="{{ route('admin.dashboard') }}" method="GET" class="d-flex gap-2" style="max-width: 350px;">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control border-start-0 form-control-sm" placeholder="Cari nama atau email..." value="{{ $search }}">
                </div>
                <button type="submit" class="btn btn-sm btn-primary text-white">Cari</button>
                @if($search)
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
                @endif
            </form>
        </div>

        @if(count($students) > 0)
            <div class="table-responsive rounded-3 border-0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Mahasiswa</th>
                            <th>Email</th>
                            <th>Tanggal Terdaftar</th>
                            <th class="text-center">Mata Kuliah</th>
                            <th class="text-center">Tugas</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($student->photo)
                                            <img src="{{ asset('storage/' . $student->photo) }}" alt="Avatar" class="avatar-img me-3">
                                        @else
                                            <div class="avatar-img d-flex align-items-center justify-content-center bg-indigo-subtle text-indigo fw-bold me-3" style="background-color: #e0e7ff; color: #4338ca; width: 45px; height: 45px; border-radius: 50%;">
                                                {{ strtoupper(substr($student->name, 0, 1)) }}
                                            </div>
                                        @endif
                                        <span class="fw-bold text-dark">{{ $student->name }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-secondary small">{{ $student->email }}</span>
                                </td>
                                <td>
                                    <span class="text-secondary small"><i class="bi bi-calendar-event me-1"></i>{{ $student->created_at->format('d M Y') }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill fw-bold">{{ $student->subjects_count }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-info-subtle text-info border border-info-subtle rounded-pill fw-bold">{{ $student->tasks_count }}</span>
                                </td>
                                <td class="text-end">
                                    <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" class="delete-student-form d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger border-0 rounded-3 px-3 py-1.5 fw-semibold small">
                                            <i class="bi bi-trash3 me-1"></i> Hapus Akun
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $students->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-people fs-1 text-muted opacity-50 mb-3 d-block"></i>
                <h6 class="fw-bold text-dark">Tidak ada mahasiswa terdaftar</h6>
                <p class="text-muted small">Mahasiswa yang mendaftar di StudySync akan muncul di sini.</p>
            </div>
        @endif
    </div>

    <!-- Confirmation Swal Script -->
    @push('scripts')
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                const forms = document.querySelectorAll('.delete-student-form');
                forms.forEach(form => {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        Swal.fire({
                            title: 'Hapus Akun Mahasiswa?',
                            text: "Semua data mata kuliah, tugas, reminder, dan file lampiran mahasiswa ini akan dihapus permanen secara otomatis!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#ef4444',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Ya, hapus permanen!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
