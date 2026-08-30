<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold">Tambah Data Pengadu</h2>
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

            <form action="{{ route('pengadu.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" class="form-control" placeholder="Masukkan nama lengkap" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">NIK</label>
                    <input type="text" name="nik" value="{{ old('nik') }}" class="form-control" placeholder="Masukkan 16 digit NIK" maxlength="20" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan alamat lengkap" required>{{ old('alamat') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">No. Telepon</label>
                    <input type="text" name="no_telepon" value="{{ old('no_telepon') }}" class="form-control" placeholder="Contoh: 081234567890" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Scan KTP (opsional)</label>
                    <input type="file" name="scan_ktp" class="form-control" accept="image/*">
                    <small class="text-muted">Format: JPG, PNG. Maks 2MB.</small>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-lg"></i> Simpan
                    </button>
                    <a href="{{ route('pengadu.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>