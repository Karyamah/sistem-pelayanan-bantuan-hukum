<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold">Edit Dokumentasi Kegiatan</h2>
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

            <form action="{{ route('dokumentasi.update', $dokumentasi) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Judul Kegiatan</label>
                    <input type="text" name="judul_kegiatan" value="{{ old('judul_kegiatan', $dokumentasi->judul_kegiatan) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Kegiatan</label>
                    <input type="date" name="tanggal_kegiatan" value="{{ old('tanggal_kegiatan', $dokumentasi->tanggal_kegiatan) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Foto Saat Ini</label>
                    <img src="{{ asset('storage/' . $dokumentasi->foto) }}" style="max-width: 250px;" class="rounded border mb-2">
                </div>

                <div class="mb-3">
                    <label class="form-label">Ganti Foto (opsional)</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="3">{{ old('keterangan', $dokumentasi->keterangan) }}</textarea>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-lg"></i> Update
                    </button>
                    <a href="{{ route('dokumentasi.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>