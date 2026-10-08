<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold">Edit Notulensi</h2>
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

            <form action="{{ route('notulensi.update', $notulensi) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">No. Registrasi</label>
                        <input type="text" name="no_registrasi" value="{{ old('no_registrasi', $notulensi->no_registrasi) }}" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal & Waktu</label>
                        <input type="datetime-local" name="tanggal_waktu" value="{{ old('tanggal_waktu', $notulensi->tanggal_waktu->format('Y-m-d\TH:i')) }}" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pengadu</label>
                    <select name="pengadu_id" class="form-select" required>
                        <option value="">-- Pilih Pengadu --</option>
                        @foreach ($pengadus as $p)
                            <option value="{{ $p->id }}" {{ old('pengadu_id', $notulensi->pengadu_id) == $p->id ? 'selected' : '' }}>
                                {{ $p->nama }} ({{ $p->nik }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select" required>
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin', $notulensi->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin', $notulensi->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Umur</label>
                        <input type="number" name="umur" value="{{ old('umur', $notulensi->umur) }}" class="form-control" min="1" max="150" required>
                    </div>
                </div>

                
<div class="mb-3">
    <label class="form-label">Perihal</label>
    <input type="text" name="perihal" value="{{ old('perihal', $notulensi->perihal) }}" class="form-control" list="daftar-perihal" placeholder="Pilih dari daftar atau ketik sendiri" autocomplete="off" required>
    <datalist id="daftar-perihal">
        @foreach (\App\Models\Notulensi::PERIHAL as $p)
            <option value="{{ $p }}">
        @endforeach
    </datalist>
    <small class="text-muted">Hapus isi kolom untuk melihat semua pilihan, atau ketik sendiri.</small>
</div>
                <div class="mb-3">
                    <label class="form-label">Uraian Singkat / Kronologi</label>
                    <textarea name="uraian_kronologi" class="form-control" rows="4" required>{{ old('uraian_kronologi', $notulensi->uraian_kronologi) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Penanganan</label>
                    <textarea name="penanganan" class="form-control" rows="3">{{ old('penanganan', $notulensi->penanganan) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
    @foreach (\App\Models\Notulensi::STATUS as $kode => $info)
        <option value="{{ $kode }}" {{ old('status') == $kode ? 'selected' : '' }}>{{ $info['label'] }}</option>
    @endforeach
</select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">PIC</label>
                        <input type="text" name="pic" value="{{ old('pic', $notulensi->pic) }}" class="form-control" placeholder="Contoh: Ferry, Angling">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Notulis</label>
                        <input type="text" name="notulis" value="{{ old('notulis', $notulensi->notulis) }}" class="form-control" placeholder="Contoh: Ananta dan Fitri">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Catatan</label>
                    <textarea name="catatan" class="form-control" rows="2">{{ old('catatan', $notulensi->catatan) }}</textarea>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-lg"></i> Update
                    </button>
                    <a href="{{ route('pengadu.show', $notulensi->pengadu_id) }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>