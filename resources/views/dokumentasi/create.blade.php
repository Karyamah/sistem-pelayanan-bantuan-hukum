<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold">Tambah Dokumentasi Kegiatan</h2>
    </x-slot>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('dokumentasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Judul Kegiatan</label>
                    <input type="text" name="judul_kegiatan" value="{{ old('judul_kegiatan') }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Kegiatan</label>
                    <input type="date" name="tanggal_kegiatan" value="{{ old('tanggal_kegiatan') }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto Kegiatan</label>
                    <input type="file" name="foto" class="form-control" accept="image/*" required>
                    <small class="text-muted">Format: JPG, PNG. Maks 2MB.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="3">{{ old('keterangan') }}</textarea>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-lg"></i> Simpan
                    </button>
                    <a href="{{ route('dokumentasi.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>