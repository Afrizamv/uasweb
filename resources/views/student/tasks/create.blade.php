<x-app-layout>
    @section('title', 'Tambah Tugas')
    @section('page_title', 'Tugas Baru')

    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card border-0 rounded-4 shadow-sm p-4">
                <div class="d-flex align-items-center mb-4">
                    <a href="{{ route('student.tasks.index') }}" class="btn btn-outline-secondary btn-sm rounded-circle me-3" style="width: 32px; height: 32px; padding: 3px 0 0 0;">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    <h5 class="fw-bold mb-0 text-dark">Form Tambah Tugas Baru</h5>
                </div>

                @if(count($subjects) == 0)
                    <div class="alert alert-warning border-0 rounded-3 shadow-sm mb-0">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        Anda harus menambahkan <strong>Mata Kuliah</strong> terlebih dahulu sebelum dapat membuat tugas kuliah. 
                        <a href="{{ route('student.subjects.create') }}" class="alert-link text-decoration-none fw-bold ms-1">Tambah Mata Kuliah <i class="bi bi-arrow-right"></i></a>
                    </div>
                @else
                    <form action="{{ route('student.tasks.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Subject -->
                        <div class="mb-3">
                            <label for="subject_id" class="form-label text-secondary fw-semibold">Mata Kuliah</label>
                            <select name="subject_id" id="subject_id" class="form-select @error('subject_id') is-invalid @enderror" required>
                                <option value="" disabled selected>Pilih mata kuliah...</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                        [{{ $subject->kode_mata_kuliah }}] {{ $subject->nama_mata_kuliah }}
                                    </option>
                                @endforeach
                            </select>
                            @error('subject_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Title -->
                        <div class="mb-3">
                            <label for="judul" class="form-label text-secondary fw-semibold">Judul Tugas</label>
                            <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" placeholder="Contoh: Membuat Landing Page HTML/CSS" value="{{ old('judul') }}" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label text-secondary fw-semibold">Deskripsi Tugas</label>
                            <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Masukkan instruksi pengerjaan tugas, link referensi, atau poin penting lainnya...">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <!-- Deadline -->
                            <div class="col-md-6 mb-3">
                                <label for="deadline" class="form-label text-secondary fw-semibold">Batas Waktu (Deadline)</label>
                                <input type="datetime-local" name="deadline" id="deadline" class="form-control @error('deadline') is-invalid @enderror" value="{{ old('deadline') }}" required>
                                @error('deadline')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Priority -->
                            <div class="col-md-6 mb-3">
                                <label for="prioritas" class="form-label text-secondary fw-semibold">Prioritas Tugas</label>
                                <select name="prioritas" id="prioritas" class="form-select @error('prioritas') is-invalid @enderror" required>
                                    <option value="Low" {{ old('prioritas') == 'Low' ? 'selected' : '' }}>Low (Rendah)</option>
                                    <option value="Medium" {{ old('prioritas', 'Medium') == 'Medium' ? 'selected' : '' }}>Medium (Sedang)</option>
                                    <option value="High" {{ old('prioritas') == 'High' ? 'selected' : '' }}>High (Tinggi)</option>
                                </select>
                                @error('prioritas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Status -->
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label text-secondary fw-semibold">Status Tugas</label>
                                <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="Belum Dimulai" {{ old('status', 'Belum Dimulai') == 'Belum Dimulai' ? 'selected' : '' }}>Belum Dimulai</option>
                                    <option value="Sedang Dikerjakan" {{ old('status') == 'Sedang Dikerjakan' ? 'selected' : '' }}>Sedang Dikerjakan</option>
                                    <option value="Selesai" {{ old('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="Terlambat" {{ old('status') == 'Terlambat' ? 'selected' : '' }}>Terlambat</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Attachment -->
                            <div class="col-md-6 mb-3">
                                <label for="lampiran" class="form-label text-secondary fw-semibold">Upload Lampiran (Max 10 MB)</label>
                                <input type="file" name="lampiran" id="lampiran" class="form-control @error('lampiran') is-invalid @enderror">
                                <span class="text-muted small">Format: PDF, DOCX, PPT, ZIP, RAR.</span>
                                @error('lampiran')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 border-top pt-3 mt-4">
                            <a href="{{ route('student.tasks.index') }}" class="btn btn-outline-secondary text-dark">Batal</a>
                            <button type="submit" class="btn btn-primary text-white">Simpan Tugas</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
