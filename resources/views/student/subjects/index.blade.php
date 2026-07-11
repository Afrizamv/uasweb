<x-app-layout>
    @section('title', 'Mata Kuliah')
    @section('page_title', 'Manajemen Mata Kuliah')

    @if(!auth()->user()->is_premium)
        <div class="alert alert-info border-0 rounded-4 d-flex flex-wrap justify-content-between align-items-center mb-4 p-3" style="background: rgba(245, 158, 11, 0.1) !important; border: 1px solid rgba(245, 158, 11, 0.2) !important;">
            <div class="d-flex align-items-center">
                <div class="rounded-circle p-2 bg-warning-subtle text-warning me-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                        <path d="M5 16L3 5L8.5 10L12 4L15.5 10L21 5L19 16H5M19 19C19 19.6 18.6 20 18 20H6C5.4 20 5 19.6 5 19V18H19V19Z" />
                    </svg>
                </div>
                <div>
                    <h6 class="text-white mb-0 fw-semibold">Akun Free - Batas Mata Kuliah</h6>
                    <p class="text-secondary small mb-0">Kuota Terpakai: <strong class="text-warning">{{ auth()->user()->subjects()->count() }}/5</strong>. Upgrade ke Premium untuk membuat mata kuliah tanpa batas.</p>
                </div>
            </div>
            <a href="{{ route('student.upgrade') }}" class="btn btn-sm btn-warning text-dark fw-bold mt-2 mt-sm-0 px-3 py-2"><i class="bi bi-crown-fill me-1"></i>Upgrade ke Premium</a>
        </div>
    @endif

    <div class="row mb-4 align-items-center">
        <!-- Search and Action Bar -->
        <div class="col-12 col-md-6 mb-3 mb-md-0">
            <form action="{{ route('student.subjects.index') }}" method="GET" class="d-flex gap-2">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control border-start-0" placeholder="Cari mata kuliah, kode, atau dosen..." value="{{ $search }}">
                </div>
                <button type="submit" class="btn btn-primary text-white">Cari</button>
                @if($search)
                    <a href="{{ route('student.subjects.index') }}" class="btn btn-outline-secondary">Reset</a>
                @endif
            </form>
        </div>
        <div class="col-12 col-md-6 text-md-end">
            <a href="{{ route('student.subjects.create') }}" class="btn btn-primary text-white">
                <i class="bi bi-plus-circle-fill me-2"></i>Tambah Mata Kuliah
            </a>
        </div>
    </div>

    <!-- Subjects Grid -->
    @if(count($subjects) > 0)
        <div class="row g-4">
            @foreach($subjects as $subject)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card border-0 rounded-4 shadow-sm h-100 overflow-hidden custom-card" style="border-left: 6px solid {{ $subject->warna }} !important;">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-2.5 py-1 fw-bold small">
                                    Semester {{ $subject->semester }}
                                </span>
                                <span class="badge rounded-pill small px-2 py-1 text-uppercase text-white fw-bold" style="background-color: {{ $subject->warna }};">
                                    {{ $subject->kode_mata_kuliah }}
                                </span>
                            </div>
                            <h5 class="fw-bold text-dark mb-2 mt-3">{{ $subject->nama_mata_kuliah }}</h5>
                            <hr class="my-3 opacity-25">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-person-badge text-muted me-2 fs-5"></i>
                                <span class="text-secondary small fw-medium">Dosen: <strong class="text-dark">{{ $subject->dosen }}</strong></span>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0 px-4 pb-4 pt-0 d-flex justify-content-end gap-2">
                            <a href="{{ route('student.subjects.edit', $subject->id) }}" class="btn btn-sm btn-outline-primary border-0 rounded-3 px-3 py-2">
                                <i class="bi bi-pencil-square me-1"></i> Edit
                            </a>
                            <form action="{{ route('student.subjects.destroy', $subject->id) }}" method="POST" class="delete-subject-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger border-0 rounded-3 px-3 py-2">
                                    <i class="bi bi-trash3 me-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5">
            {{ $subjects->links() }}
        </div>
    @else
        <div class="card border-0 rounded-4 shadow-sm p-5 text-center">
            <div class="py-5">
                <i class="bi bi-journal-x fs-1 text-muted opacity-50 mb-3 d-block"></i>
                <h5 class="fw-bold text-dark">Belum ada Mata Kuliah</h5>
                <p class="text-muted">Mata kuliah yang Anda tambahkan akan muncul di sini. Silakan tambahkan mata kuliah baru.</p>
                <a href="{{ route('student.subjects.create') }}" class="btn btn-primary text-white mt-3">
                    <i class="bi bi-plus-circle-fill me-2"></i>Tambah Mata Kuliah Pertama
                </a>
            </div>
        </div>
    @endif

    <!-- Delete Confirmation Modal Script -->
    @push('scripts')
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                const forms = document.querySelectorAll('.delete-subject-form');
                forms.forEach(form => {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        Swal.fire({
                            title: 'Apakah Anda yakin?',
                            text: "Menghapus mata kuliah juga akan menghapus seluruh tugas dan reminder di dalamnya!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#ef4444',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Ya, hapus!',
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
