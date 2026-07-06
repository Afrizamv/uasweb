<x-app-layout>
    @section('title', 'Admin - Semua Mata Kuliah')
    @section('page_title', 'Semua Mata Kuliah (SaaS)')

    <div class="card border-0 rounded-4 shadow-sm p-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
            <h5 class="fw-bold text-dark mb-3 mb-md-0"><i class="bi bi-book-half text-indigo me-2"></i>Daftar Mata Kuliah Seluruh Mahasiswa</h5>
            
            <form action="{{ route('admin.subjects') }}" method="GET" class="d-flex gap-2" style="max-width: 380px;">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control border-start-0 form-control-sm" placeholder="Mata kuliah, kode, dosen, mahasiswa..." value="{{ $search }}">
                </div>
                <button type="submit" class="btn btn-sm btn-primary text-white">Cari</button>
                @if($search)
                    <a href="{{ route('admin.subjects') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
                @endif
            </form>
        </div>

        @if(count($subjects) > 0)
            <div class="table-responsive rounded-3 border-0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Mahasiswa Pemilik</th>
                            <th>Mata Kuliah</th>
                            <th>Kode</th>
                            <th>Dosen</th>
                            <th class="text-center">Semester</th>
                            <th>Dibuat Pada</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subjects as $subject)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($subject->user->photo)
                                            <img src="{{ asset('storage/' . $subject->user->photo) }}" alt="Avatar" class="avatar-img me-2" style="width: 32px; height: 32px;">
                                        @else
                                            <div class="avatar-img d-flex align-items-center justify-content-center bg-indigo-subtle text-indigo fw-bold me-2" style="background-color: #e0e7ff; color: #4338ca; width: 32px; height: 32px; border-radius: 50%; font-size: 0.85rem;">
                                                {{ strtoupper(substr($subject->user->name, 0, 1)) }}
                                            </div>
                                        @endif
                                        <span class="fw-semibold text-dark small">{{ $subject->user->name }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="d-inline-block rounded-circle me-2" style="width: 12px; height: 12px; background-color: {{ $subject->warna ?? '#ccc' }};"></span>
                                        <span class="text-dark fw-bold">{{ $subject->nama_mata_kuliah }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill small fw-semibold text-uppercase">{{ $subject->kode_mata_kuliah }}</span>
                                </td>
                                <td>
                                    <span class="text-secondary small">{{ $subject->dosen }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="text-dark small fw-bold">{{ $subject->semester }}</span>
                                </td>
                                <td>
                                    <span class="text-muted small">{{ $subject->created_at->format('d M Y H:i') }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $subjects->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-book fs-1 text-muted opacity-50 mb-3 d-block"></i>
                <h6 class="fw-bold text-dark">Belum ada mata kuliah dalam sistem</h6>
                <p class="text-muted small">Ketika mahasiswa menambahkan mata kuliah, datanya akan termonitor di sini.</p>
            </div>
        @endif
    </div>
</x-app-layout>
