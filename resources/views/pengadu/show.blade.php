<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold">Detail Pengadu</h2>
    </x-slot>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <table class="table table-borderless">
                <tr>
                    <th style="width: 200px;">Nama</th>
                    <td>: {{ $pengadu->nama }}</td>
                </tr>
                <tr>
                    <th>NIK</th>
                    <td>: {{ $pengadu->nik }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>: {{ $pengadu->alamat }}</td>
                </tr>
                <tr>
                    <th>No. Telepon</th>
                    <td>: {{ $pengadu->no_telepon }}</td>
                </tr>
                <tr>
                    <th>Scan KTP</th>
                    <td>:
                        @if ($pengadu->scan_ktp)
                            <br><img src="{{ asset('storage/' . $pengadu->scan_ktp) }}" style="max-width: 300px;" class="rounded border mt-2">
                        @else
                            <span class="text-muted">Belum ada</span>
                        @endif
                    </td>
                </tr>
            </table>

                        <a href="{{ route('pengadu.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>

        </div>
    </div>

    <div class="card border-0 shadow-sm mt-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-semibold mb-0">Riwayat Notulensi & Tindak Lanjut</h6>
                <a href="{{ route('notulensi.create', ['pengadu_id' => $pengadu->id]) }}" class="btn btn-sm btn-success">
                    <i class="bi bi-plus-lg"></i> Catat Notulensi Baru
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No. Registrasi</th>
                            <th>Tanggal</th>
                            <th>Perihal</th>
                            <th>Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengadu->notulensis as $item)
                            <tr>
                                <td>{{ $item->no_registrasi }}</td>
                                <td>{{ $item->tanggal_waktu->format('d/m/Y') }}</td>
                                <td>{{ Str::limit($item->perihal, 30) }}</td>
                                <td>
                                    <span class="badge {{ $item->status_badge }}">{{ $item->status_label }}</span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('notulensi.show', $item) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('notulensi.edit', $item) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-3">Belum ada notulensi untuk pengaduan ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>