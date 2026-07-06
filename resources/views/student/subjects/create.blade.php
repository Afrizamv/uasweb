<x-app-layout>
    @section('title', 'Tambah Mata Kuliah')
    @section('page_title', 'Mata Kuliah Baru')

    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card border-0 rounded-4 shadow-sm p-4">
                <div class="d-flex align-items-center mb-4">
                    <a href="{{ route('student.subjects.index') }}" class="btn btn-outline-secondary btn-sm rounded-circle me-3" style="width: 32px; height: 32px; padding: 3px 0 0 0;">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    <h5 class="fw-bold mb-0 text-dark">Form Tambah Mata Kuliah</h5>
                </div>

                <form action="{{ route('student.subjects.store') }}" method="POST">
                    @csrf

                    <!-- Subject Name -->
                    <div class="mb-3">
                        <label for="nama_mata_kuliah" class="form-label text-secondary fw-semibold">Nama Mata Kuliah</label>
                        <input type="text" name="nama_mata_kuliah" id="nama_mata_kuliah" class="form-control @error('nama_mata_kuliah') is-invalid @enderror" placeholder="Contoh: Pemrograman Web" value="{{ old('nama_mata_kuliah') }}" required>
                        @error('nama_mata_kuliah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <!-- Subject Code -->
                        <div class="col-md-6 mb-3">
                            <label for="kode_mata_kuliah" class="form-label text-secondary fw-semibold">Kode Mata Kuliah</label>
                            <input type="text" name="kode_mata_kuliah" id="kode_mata_kuliah" class="form-control @error('kode_mata_kuliah') is-invalid @enderror" placeholder="Contoh: IF-301" value="{{ old('kode_mata_kuliah') }}" required>
                            @error('kode_mata_kuliah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Semester -->
                        <div class="col-md-6 mb-3">
                            <label for="semester" class="form-label text-secondary fw-semibold">Semester</label>
                            <input type="number" name="semester" id="semester" class="form-control @error('semester') is-invalid @enderror" placeholder="Contoh: 4" min="1" max="20" value="{{ old('semester') }}" required>
                            @error('semester')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Lecturer -->
                    <div class="mb-3">
                        <label for="dosen" class="form-label text-secondary fw-semibold">Nama Dosen Pengampu</label>
                        <input type="text" name="dosen" id="dosen" class="form-control @error('dosen') is-invalid @enderror" placeholder="Contoh: Dr. Eko Prasetyo, M.T." value="{{ old('dosen') }}" required>
                        @error('dosen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Color Marker -->
                    <div class="mb-4">
                        <label for="warna" class="form-label text-secondary fw-semibold d-block">Warna Penanda Mata Kuliah</label>
                        <div class="d-flex align-items-center gap-3">
                            <input type="color" name="warna" id="warna" class="form-control form-control-color border-0 rounded-circle" style="width: 50px; height: 50px; cursor: pointer;" value="{{ old('warna', '#6366f1') }}" required>
                            <span class="text-muted small">Pilih warna penanda untuk membedakan mata kuliah pada dashboard, tugas, dan kalender.</span>
                        </div>
                        @error('warna')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2 border-top pt-3">
                        <a href="{{ route('student.subjects.index') }}" class="btn btn-outline-secondary text-dark">Batal</a>
                        <button type="submit" class="btn btn-primary text-white">Simpan Mata Kuliah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
