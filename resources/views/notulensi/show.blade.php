<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold">Detail Notulensi</h2>
    </x-slot>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-start mb-3">
                <h5 class="fw-semibold">{{ $notulensi->no_registrasi }}</h5>

                <span class="badge fs-6 {{ $notulensi->status_badge }}">
                    {{ $notulensi->status_label }}
                </span>
            </div>

            <table class="table table-borderless">
                <tr>
                    <th style="width: 220px;">Tanggal & Waktu</th>
                    <td>: {{ $notulensi->tanggal_waktu->format('d F Y, H:i') }}</td>
                </tr>
                <tr>
                    <th>Nama Pengadu</th>
                    <td>: {{ $notulensi->pengadu->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <th>NIK</th>
                    <td>: {{ $notulensi->pengadu->nik ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Umur</th>
                    <td>: {{ $notulensi->umur ?? '-' }} tahun</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>: {{ $notulensi->pengadu->alamat ?? '-' }}</td>
                </tr>
                <tr>
                    <th>No. Telepon</th>
                    <td>: {{ $notulensi->pengadu->no_telepon ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Perihal</th>
                    <td>: {{ $notulensi->perihal }}</td>
                </tr>
                <tr>
                    <th>Uraian / Kronologi</th>
                    <td>: {{ $notulensi->uraian_kronologi }}</td>
                </tr>
                <tr>
                    <th>Penanganan</th>
                    <td>: {{ $notulensi->penanganan ?? '-' }}</td>
                </tr>
                <tr>
                    <th>PIC</th>
                    <td>: {{ $notulensi->pic ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Notulis</th>
                    <td>: {{ $notulensi->notulis ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Catatan</th>
                    <td>: {{ $notulensi->catatan ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Dicatat Oleh</th>
                    <td>: {{ $notulensi->pencatat->name ?? '-' }}</td>
                </tr>
            </table>

            <hr class="my-4">

            <h5 class="fw-semibold mb-3">
                <i class="bi bi-images"></i> Dokumentasi Foto Pengaduan
            </h5>

            @if ($notulensi->dokumentasiKegiatans->isNotEmpty())
                <div class="row g-3">
                    @foreach ($notulensi->dokumentasiKegiatans as $dokumentasi)
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="card h-100 border shadow-sm">
                                <a
                                    href="{{ asset('storage/' . $dokumentasi->foto) }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                >
                                    <img
                                        src="{{ asset('storage/' . $dokumentasi->foto) }}"
                                        class="card-img-top"
                                        alt="Dokumentasi pengaduan"
                                        style="height: 220px; object-fit: cover;"
                                    >
                                </a>

                                <div class="card-body">
                                    <p class="fw-semibold mb-2">
                                        {{ $dokumentasi->judul_kegiatan }}
                                    </p>

                                    <p class="text-muted small mb-0">
                                        {{ $dokumentasi->keterangan ?: 'Tidak ada keterangan foto.' }}
                                    </p>

                                    <small class="text-muted d-block mt-2">
                                        Tanggal:
                                        {{ \Carbon\Carbon::parse($dokumentasi->tanggal_kegiatan)->format('d F Y') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-light border mb-4">
                    <i class="bi bi-info-circle"></i>
                    Belum ada dokumentasi foto untuk notulensi ini.
                </div>
            @endif

            <div class="d-flex gap-2 mt-4">
                <a
                    href="{{ route('notulensi.edit', $notulensi) }}"
                    class="btn btn-warning"
                >
                    <i class="bi bi-pencil"></i> Edit
                </a>

                <a
                    href="{{ route('pengadu.show', $notulensi->pengadu_id) }}"
                    class="btn btn-outline-secondary"
                >
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>

        </div>
    </div>
</x-app-layout>