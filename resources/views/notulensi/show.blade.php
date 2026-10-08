<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold">Detail Notulensi</h2>
    </x-slot>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-start mb-3">
                <h5 class="fw-semibold">{{ $notulensi->no_registrasi }}</h5>
                <span class="badge fs-6 {{ $notulensi->status_badge }}">{{ $notulensi->status_label }}</span>
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
                    <th>Jenis Kelamin</th>
                    <td>: {{ $notulensi->jenis_kelamin ?? '-' }}</td>
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

            <div class="d-flex gap-2">
                <a href="{{ route('notulensi.edit', $notulensi) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
               <a href="{{ route('pengadu.show', $notulensi->pengadu_id) }}" class="btn btn-outline-secondary">
    <i class="bi bi-arrow-left"></i> Kembali
</a>
            </div>

        </div>
    </div>
</x-app-layout>