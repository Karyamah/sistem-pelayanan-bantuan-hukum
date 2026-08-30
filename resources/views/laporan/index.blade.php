<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold">Laporan Bantuan Hukum</h2>
    </x-slot>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <form method="GET" class="row g-2 align-items-end mb-4">
                <div class="col-md-3">
                    <label class="form-label small">Tanggal Awal</label>
                    <input type="date" name="tanggal_awal" value="{{ request('tanggal_awal') }}" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="form-label small">Tanggal Akhir</label>
                    <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="form-label small">Status</label>
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="baru" {{ request('status') == 'baru' ? 'selected' : '' }}>Baru</option>
                        <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-success flex-fill">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                    <a href="{{ route('laporan.pdf', request()->query()) }}" class="btn btn-outline-danger flex-fill" target="_blank">
                        <i class="bi bi-file-earmark-pdf"></i> PDF
                    </a>
                </div>
            </form>

            <div class="d-flex gap-3 mb-3">
                <span class="badge bg-light text-dark border">Total: {{ $notulensis->count() }} data</span>
                <span class="badge bg-secondary">Baru: {{ $notulensis->where('status', 'baru')->count() }}</span>
                <span class="badge bg-warning text-dark">Diproses: {{ $notulensis->where('status', 'diproses')->count() }}</span>
                <span class="badge bg-success">Selesai: {{ $notulensis->where('status', 'selesai')->count() }}</span>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No. Registrasi</th>
                            <th>Tanggal</th>
                            <th>Nama Pengadu</th>
                            <th>Perihal</th>
                            <th>PIC</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($notulensis as $item)
                            <tr>
                                <td>{{ $item->no_registrasi }}</td>
                                <td>{{ $item->tanggal_waktu->format('d/m/Y') }}</td>
                                <td>{{ $item->pengadu->nama ?? '-' }}</td>
                                <td>{{ Str::limit($item->perihal, 30) }}</td>
                                <td>{{ $item->pic ?? '-' }}</td>
                                <td>
                                    @if ($item->status == 'baru')
                                        <span class="badge bg-secondary">Baru</span>
                                    @elseif ($item->status == 'diproses')
                                        <span class="badge bg-warning text-dark">Diproses</span>
                                    @else
                                        <span class="badge bg-success">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Tidak ada data untuk filter ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>