<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold">Tambah Notulensi</h2>
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

            <form action="{{ route('notulensi.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">No. Registrasi</label>
                        <input type="text" name="no_registrasi" value="{{ old('no_registrasi', $noRegistrasi) }}" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal & Waktu</label>
                        <input type="datetime-local" name="tanggal_waktu" value="{{ old('tanggal_waktu', now()->format('Y-m-d\TH:i')) }}" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pengadu</label>
                    <select name="pengadu_id" class="form-select" required>
                        <option value="">-- Pilih Pengadu --</option>
                        @foreach ($pengadus as $p)
                            <option value="{{ $p->id }}" {{ old('pengadu_id') == $p->id ? 'selected' : '' }}>
                                {{ $p->nama }} ({{ $p->nik }})
                            </option>
                        @endforeach
                    </select>
                    @if ($pengadus->isEmpty())
                        <small class="text-danger">Belum ada data pengadu. <a href="{{ route('pengadu.create') }}">Tambah dulu di sini</a>.</small>
                    @endif
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select" required>
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Umur</label>
                        <input type="number" name="umur" value="{{ old('umur') }}" class="form-control" min="1" max="150" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Perihal</label>
                    <input type="text" name="perihal" value="{{ old('perihal') }}" class="form-control" placeholder="Contoh: Sengketa Tanah, KDRT, dll" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Uraian Singkat / Kronologi</label>
                    <textarea name="uraian_kronologi" class="form-control" rows="4" required>{{ old('uraian_kronologi') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Penanganan</label>
                    <textarea name="penanganan" class="form-control" rows="3">{{ old('penanganan') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="baru" {{ old('status') == 'baru' ? 'selected' : '' }}>Baru</option>
                            <option value="diproses" {{ old('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">PIC</label>
                        <input type="text" name="pic" value="{{ old('pic') }}" class="form-control" placeholder="Contoh: Ferry, Angling">
                        <small class="text-muted">Bisa isi lebih dari satu nama, pisahkan dengan koma.</small>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Notulis</label>
                        <input type="text" name="notulis" value="{{ old('notulis') }}" class="form-control" placeholder="Contoh: Ananta dan Fitri">
                        <small class="text-muted">Bisa isi lebih dari satu nama.</small>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Catatan</label>
                    <textarea name="catatan" class="form-control" rows="2">{{ old('catatan') }}</textarea>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-lg"></i> Simpan
                    </button>
                    <a href="{{ route('notulensi.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>