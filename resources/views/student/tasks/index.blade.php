<x-app-layout>
    @section('title', 'Daftar Tugas')
    @section('page_title', 'Manajemen Tugas Kuliah')

    @if(!auth()->user()->is_premium)
        <div class="alert alert-info border-0 rounded-4 d-flex flex-wrap justify-content-between align-items-center mb-4 p-3" style="background: rgba(14, 165, 233, 0.1) !important; border: 1px solid rgba(14, 165, 233, 0.2) !important;">
            <div class="d-flex align-items-center">
                <div class="rounded-circle p-2 bg-info-subtle text-info me-3">
                    <i class="bi bi-info-circle-fill fs-5"></i>
                </div>
                <div>
                    <h6 class="text-white mb-0 fw-semibold">Akun Free - Batas Tugas</h6>
                    <p class="text-secondary small mb-0">Kuota Terpakai: <strong class="text-info">{{ auth()->user()->tasks()->count() }}/5</strong>. Upgrade ke Premium untuk membuat tugas tanpa batas.</p>
                </div>
            </div>
            <a href="{{ route('student.upgrade') }}" class="btn btn-sm btn-warning text-dark fw-bold mt-2 mt-sm-0 px-3 py-2"><i class="bi bi-crown-fill me-1"></i>Upgrade ke Premium</a>
        </div>
    @endif

    <!-- Search & Filters -->
    <div class="card border-0 rounded-4 shadow-sm p-4 mb-4">
        <form action="{{ route('student.tasks.index') }}" method="GET">
            <div class="row g-3 align-items-end">
                <div class="col-12 col-md-4">
                    <label class="form-label text-secondary fw-semibold small">Pencarian</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" class="form-control border-start-0" placeholder="Judul, deskripsi, atau matkul..." value="{{ $search }}">
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <label class="form-label text-secondary fw-semibold small">Filter Status</label>
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="Belum Dimulai" {{ $status == 'Belum Dimulai' ? 'selected' : '' }}>Belum Dimulai</option>
                        <option value="Sedang Dikerjakan" {{ $status == 'Sedang Dikerjakan' ? 'selected' : '' }}>Sedang Dikerjakan</option>
                        <option value="Selesai" {{ $status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="Terlambat" {{ $status == 'Terlambat' ? 'selected' : '' }}>Terlambat</option>
                    </select>
                </div>
                <div class="col-6 col-md-3">
                    <label class="form-label text-secondary fw-semibold small">Filter Prioritas</label>
                    <select name="prioritas" class="form-select">
                        <option value="">Semua Prioritas</option>
                        <option value="Low" {{ $priority == 'Low' ? 'selected' : '' }}>Low</option>
                        <option value="Medium" {{ $priority == 'Medium' ? 'selected' : '' }}>Medium</option>
                        <option value="High" {{ $priority == 'High' ? 'selected' : '' }}>High</option>
                    </select>
                </div>
                <div class="col-12 col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-primary text-white w-100">Filter</button>
                    @if($search || $status || $priority)
                        <a href="{{ route('student.tasks.index') }}" class="btn btn-outline-secondary">Reset</a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- Add Task Bar -->
    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('student.tasks.create') }}" class="btn btn-primary text-white">
            <i class="bi bi-plus-circle-fill me-2"></i>Tambah Tugas Baru
        </a>
    </div>

    <!-- Tasks List Table -->
    @if(count($tasks) > 0)
        <div class="table-responsive shadow-sm rounded-4 border-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="width: 25%">Tugas & Deskripsi</th>
                        <th style="width: 20%">Mata Kuliah</th>
                        <th style="width: 15%">Batas Waktu</th>
                        <th style="width: 10%">Prioritas</th>
                        <th style="width: 12%">Status</th>
                        <th style="width: 8%">Lampiran</th>
                        <th style="width: 10%" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                        @php
                            $isOverdue = \Carbon\Carbon::parse($task->deadline)->isPast() && $task->status !== 'Selesai';
                        @endphp
                        <tr class="{{ $isOverdue ? 'table-danger-subtle' : '' }}">
                            <td>
                                <span class="fw-bold text-dark d-block text-truncate" style="max-width: 250px;">{{ $task->judul }}</span>
                                <span class="text-muted small text-truncate d-block" style="max-width: 250px;">
                                    {{ $task->deskripsi ?? 'Tidak ada deskripsi.' }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="d-inline-block rounded-circle me-2" style="width: 12px; height: 12px; background-color: {{ $task->subject->warna ?? '#ccc' }};"></span>
                                    <span class="fw-medium text-dark">{{ $task->subject->nama_mata_kuliah }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="small fw-semibold text-secondary">
                                    <i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}
                                </span>
                                <span class="small text-muted d-block mt-0.5">
                                    <i class="bi bi-clock me-1"></i> {{ \Carbon\Carbon::parse($task->deadline)->format('H:i') }} WIB
                                </span>
                            </td>
                            <td>
                                @if($task->prioritas == 'High')
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill small px-2.5 py-1 fw-bold">High</span>
                                @elseif($task->prioritas == 'Medium')
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill small px-2.5 py-1 fw-bold">Medium</span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill small px-2.5 py-1 fw-bold">Low</span>
                                @endif
                            </td>
                            <td>
                                @if($isOverdue)
                                    <span class="badge bg-danger text-white rounded-pill px-2.5 py-1 fw-bold small"><i class="bi bi-exclamation-octagon-fill me-1"></i>Terlambat</span>
                                @elseif($task->status == 'Selesai')
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2.5 py-1 fw-bold small"><i class="bi bi-check-circle-fill me-1"></i>Selesai</span>
                                @elseif($task->status == 'Sedang Dikerjakan')
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-2.5 py-1 fw-bold small"><i class="bi bi-play-circle-fill me-1"></i>Sedang Dikerjakan</span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-2.5 py-1 fw-bold small"><i class="bi bi-pause-circle-fill me-1"></i>Belum Dimulai</span>
                                @endif
                            </td>
                            <td>
                                @if($task->lampiran)
                                    <a href="{{ asset('storage/' . $task->lampiran) }}" target="_blank" class="btn btn-sm btn-outline-primary border-0 rounded-circle" style="width: 32px; height: 32px; padding: 4px 0 0 0;" title="Download Lampiran">
                                        <i class="bi bi-file-earmark-arrow-down-fill"></i>
                                    </a>
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="{{ route('student.tasks.edit', $task->id) }}" class="btn btn-sm btn-outline-primary border-0 rounded-3 px-2 py-1.5" title="Edit Tugas">
                                        <i class="bi bi-pencil-square fs-6"></i>
                                    </a>
                                    <form action="{{ route('student.tasks.destroy', $task->id) }}" method="POST" class="delete-task-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger border-0 rounded-3 px-2 py-1.5" title="Hapus Tugas">
                                            <i class="bi bi-trash3 fs-6"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $tasks->links() }}
        </div>
    @else
        <div class="card border-0 rounded-4 shadow-sm p-5 text-center">
            <div class="py-5">
                <i class="bi bi-journal-check fs-1 text-muted opacity-50 mb-3 d-block"></i>
                <h5 class="fw-bold text-dark">Belum ada Tugas Kuliah</h5>
                <p class="text-muted">Semua tugas mata kuliah yang Anda tambahkan akan muncul di sini. Silakan tambahkan tugas baru.</p>
                <a href="{{ route('student.tasks.create') }}" class="btn btn-primary text-white mt-3">
                    <i class="bi bi-plus-circle-fill me-2"></i>Tambah Tugas Pertama
                </a>
            </div>
        </div>
    @endif

    <!-- Delete Confirmation Modal Script -->
    @push('scripts')
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                const forms = document.querySelectorAll('.delete-task-form');
                forms.forEach(form => {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        Swal.fire({
                            title: 'Apakah Anda yakin?',
                            text: "Anda akan menghapus tugas ini secara permanen beserta file lampirannya!",
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
