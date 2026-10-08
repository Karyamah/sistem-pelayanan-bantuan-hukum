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
                        <input type="text"
                            name="no_registrasi"
                            value="{{ old('no_registrasi', $noRegistrasi) }}"
                            class="form-control"
                            required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal & Waktu</label>
                        <input type="datetime-local"
                            name="tanggal_waktu"
                            value="{{ old('tanggal_waktu', now()->format('Y-m-d\TH:i')) }}"
                            class="form-control"
                            required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pengaduan</label>

                    @if ($selectedPengadu)

                        <div class="form-control bg-light">
                            {{ $selectedPengadu->nama }} ({{ $selectedPengadu->nik }})
                        </div>

                        <input type="hidden"
                            name="pengadu_id"
                            value="{{ $selectedPengadu->id }}">

                    @else

                        <select name="pengadu_id"
                            class="form-select"
                            required>

                            <option value="">-- Pilih Pengaduan --</option>

                            @foreach ($pengadus as $p)
                                <option value="{{ $p->id }}"
                                    {{ old('pengadu_id') == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama }} ({{ $p->nik }})
                                </option>
                            @endforeach

                        </select>

                        @if ($pengadus->isEmpty())
                            <small class="text-danger">
                                Belum ada data pengaduan.
                                <a href="{{ route('pengadu.create') }}">
                                    Tambah dulu di sini
                                </a>.
                            </small>
                        @endif

                    @endif
                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jenis Kelamin</label>

                        <select name="jenis_kelamin"
                            class="form-select"
                            required>

                            <option value="">-- Pilih --</option>

                            <option value="Laki-laki"
                                {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                Laki-laki
                            </option>

                            <option value="Perempuan"
                                {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan
                            </option>

                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Umur</label>

                        <input type="number"
                            name="umur"
                            value="{{ old('umur') }}"
                            class="form-control"
                            min="1"
                            max="150"
                            required>
                    </div>

                </div>

                {{-- PERIHAL --}}
                <div class="mb-3">

                    <label class="form-label">Perihal</label>

                    <input type="text"
                        name="perihal"
                        value="{{ old('perihal') }}"
                        class="form-control"
                        list="daftar-perihal"
                        placeholder="Pilih perihal atau ketik sendiri"
                        autocomplete="off"
                        required>

                    <datalist id="daftar-perihal">

                        <option value="Sengketa Tanah">
                        <option value="Perkara Pidana Umum">
                        <option value="Kasus Ingkar Janji / Penipuan">
                        <option value="Pidana Anak">
                        <option value="Bantuan Hukum">
                        <option value="Konsultasi Hukum">
                        <option value="Perselisihan Administrasi">

                    </datalist>

                    <small class="text-muted">
                        Pilih dari daftar yang tersedia atau ketik sendiri jika perihal tidak ada.
                    </small>

                </div>

                {{-- URAIAN / KRONOLOGI --}}
                <div class="mb-3">

                    <label class="form-label">
                        Uraian Singkat / Kronologi
                    </label>

                    <textarea name="uraian_kronologi"
                        class="form-control"
                        rows="4"
                        required>{{ old('uraian_kronologi') }}</textarea>

                </div>

                {{-- STATUS, PIC, NOTULIS --}}
                <div class="row">

                    <div class="col-md-4 mb-3">

                        <label class="form-label">Status</label>

                        <select name="status"
                            class="form-select"
                            required>

                            @foreach (\App\Models\Notulensi::STATUS as $kode => $info)

                                <option value="{{ $kode }}"
                                    {{ old('status') == $kode ? 'selected' : '' }}>
                                    {{ $info['label'] }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="form-label">PIC</label>

                        <input type="text"
                            name="pic"
                            value="{{ old('pic') }}"
                            class="form-control"
                            placeholder="Contoh: Ferry, Angling">

                        <small class="text-muted">
                            Bisa isi lebih dari satu nama, pisahkan dengan koma.
                        </small>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="form-label">Notulis</label>

                        <input type="text"
                            name="notulis"
                            value="{{ old('notulis') }}"
                            class="form-control"
                            placeholder="Contoh: Ananta dan Fitri">

                        <small class="text-muted">
                            Bisa isi lebih dari satu nama.
                        </small>

                    </div>

                </div>

                {{-- CATATAN --}}
                <div class="mb-3">

                    <label class="form-label">Catatan</label>

                    <textarea name="catatan"
                        class="form-control"
                        rows="2">{{ old('catatan') }}</textarea>

                </div>

                {{-- TOMBOL --}}
                <div class="d-flex gap-2 mt-4">

                    <button type="submit"
                        class="btn btn-success">

                        <i class="bi bi-check-lg"></i>
                        Simpan

                    </button>

                    <a href="{{ $selectedPengadu ? route('pengadu.show', $selectedPengadu->id) : route('pengadu.index') }}"
                        class="btn btn-outline-secondary">

                        Batal

                    </a>

                </div>

            </form>

        </div>
    </div>
</x-app-layout>