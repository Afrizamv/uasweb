<x-app-layout>
    @section('title', 'Admin - Semua Tugas')
    @section('page_title', 'Semua Tugas Kuliah (SaaS)')

    <!-- Search & Filters -->
    <div class="card border-0 rounded-4 shadow-sm p-4 mb-4">
        <form action="{{ route('admin.tasks') }}" method="GET">
            <div class="row g-3 align-items-end">
                <div class="col-12 col-md-4">
                    <label class="form-label text-secondary fw-semibold small">Pencarian Global</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" class="form-control border-start-0" placeholder="Tugas, matkul, mahasiswa..." value="{{ $search }}">
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
                        <a href="{{ route('admin.tasks') }}" class="btn btn-outline-secondary">Reset</a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- Tasks Monitor Table -->
    @if(count($tasks) > 0)
        <div class="table-responsive shadow-sm rounded-4 border-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Mahasiswa</th>
                        <th>Tugas</th>
                        <th>Mata Kuliah</th>
                        <th>Batas Waktu</th>
                        <th>Prioritas</th>
                        <th>Status</th>
                        <th>Lampiran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                        @php
                            $isOverdue = \Carbon\Carbon::parse($task->deadline)->isPast() && $task->status !== 'Selesai';
                        @endphp
                        <tr class="{{ $isOverdue ? 'table-danger-subtle' : '' }}">
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($task->subject->user->photo)
                                        <img src="{{ asset('storage/' . $task->subject->user->photo) }}" alt="Avatar" class="avatar-img me-2" style="width: 32px; height: 32px;">
                                    @else
                                        <div class="avatar-img d-flex align-items-center justify-content-center bg-indigo-subtle text-indigo fw-bold me-2" style="background-color: #e0e7ff; color: #4338ca; width: 32px; height: 32px; border-radius: 50%; font-size: 0.85rem;">
                                            {{ strtoupper(substr($task->subject->user->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <span class="fw-semibold text-dark small">{{ $task->subject->user->name }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="fw-bold text-dark d-block text-truncate" style="max-width: 200px;">{{ $task->judul }}</span>
                                <span class="text-muted small text-truncate d-block" style="max-width: 200px;">
                                    {{ $task->deskripsi ?? 'Tidak ada deskripsi.' }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="d-inline-block rounded-circle me-2" style="width: 12px; height: 12px; background-color: {{ $task->subject->warna ?? '#ccc' }};"></span>
                                    <span class="fw-medium text-secondary small">{{ $task->subject->nama_mata_kuliah }}</span>
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
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill small px-2 py-0.5 fw-bold">High</span>
                                @elseif($task->prioritas == 'Medium')
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill small px-2 py-0.5 fw-bold">Medium</span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill small px-2 py-0.5 fw-bold">Low</span>
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
                <i class="bi bi-card-checklist fs-1 text-muted opacity-50 mb-3 d-block"></i>
                <h5 class="fw-bold text-dark">Belum ada tugas kuliah dalam sistem</h5>
                <p class="text-muted">Ketika mahasiswa menginputkan tugas kuliah, datanya akan terdata di sini.</p>
            </div>
        </div>
    @endif
</x-app-layout>
