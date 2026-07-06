<x-app-layout>
    @section('title', 'Reminder Tugas')
    @section('page_title', 'Daftar Reminder Tugas')

    <div class="row">
        <div class="col-12">
            <div class="card border-0 rounded-4 shadow-sm p-4">
                <h5 class="fw-bold text-dark mb-4"><i class="bi bi-bell-fill text-indigo me-2"></i>Daftar Reminder Akun Anda</h5>
                
                @if(count($reminders) > 0)
                    <div class="table-responsive rounded-3 border-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tugas</th>
                                    <th>Mata Kuliah</th>
                                    <th>Tanggal Pengingat</th>
                                    <th>Status</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reminders as $reminder)
                                    <tr>
                                        <td>
                                            <span class="fw-bold text-dark">{{ $reminder->task->judul }}</span>
                                            <span class="text-muted d-block small mt-1">
                                                Batas Akhir Tugas: {{ $reminder->task->deadline->format('d M Y H:i') }} WIB
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill text-white fw-semibold small" style="background-color: {{ $reminder->task->subject->warna ?? '#ccc' }};">
                                                {{ $reminder->task->subject->nama_mata_kuliah }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="small fw-semibold text-secondary">
                                                <i class="bi bi-clock-history"></i> {{ $reminder->reminder_date->format('d M Y H:i') }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($reminder->status == 'Completed')
                                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2.5 py-1 fw-bold small">Selesai Dibaca</span>
                                            @else
                                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-2.5 py-1 fw-bold small">Pending</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            @if($reminder->status == 'Pending')
                                                <form action="{{ route('student.reminders.complete', $reminder->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-success rounded-3 px-3 py-1.5 fw-semibold small">
                                                        <i class="bi bi-check2-all me-1"></i> Tandai Dibaca
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-muted small"><i class="bi bi-check2-circle text-success fs-5"></i></span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $reminders->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-bell-slash fs-1 text-muted opacity-50 mb-3 d-block"></i>
                        <h5 class="fw-bold text-dark">Belum ada pengingat</h5>
                        <p class="text-muted small">Reminder otomatis akan dibuat ketika Anda menambahkan tugas kuliah baru.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
