<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold">Edit Data Pengadu</h2>
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

            <form action="{{ route('pengadu.update', $pengadu) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama', $pengadu->nama) }}" class="form-control" required>
                </div>

                <div class="mb-3">
    <label class="form-label">NIK</label>
    <input type="text" name="nik" value="{{ old('nik', $pengadu->nik) }}" class="form-control" maxlength="16" pattern="\d{16}" required>
</div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $pengadu->alamat) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">No. Telepon</label>
                    <input type="text" name="no_telepon" value="{{ old('no_telepon', $pengadu->no_telepon) }}" class="form-control" required>
                </div>

                @if ($pengadu->scan_ktp)
                    <div class="mb-3">
                        <label class="form-label d-block">Scan KTP Saat Ini</label>
                        <img src="{{ asset('storage/' . $pengadu->scan_ktp) }}" alt="Scan KTP" style="max-width: 250px;" class="rounded border">
                    </div>
                @endif

                <div class="mb-3">
                    <label class="form-label">Ganti Scan KTP (opsional)</label>
                    <input type="file" name="scan_ktp" class="form-control" accept="image/*">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-lg"></i> Update
                    </button>
                    <a href="{{ route('pengadu.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>