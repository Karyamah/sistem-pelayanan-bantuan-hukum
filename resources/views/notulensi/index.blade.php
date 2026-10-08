<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold">Notulensi Bantuan Hukum</h2>
    </x-slot>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                <form method="GET" class="d-flex gap-2 flex-wrap">
                    <input type="text" name="cari" value="{{ request('cari') }}" class="form-control" placeholder="Cari no. registrasi, perihal, nama..." style="min-width: 250px;">
                    <select name="status" class="form-select" style="width: auto;">
    <option value="">Semua Status</option>
    @foreach (\App\Models\Notulensi::STATUS as $kode => $info)
        <option value="{{ $kode }}" {{ request('status') == $kode ? 'selected' : '' }}>
            {{ $info['label'] }}
        </option>
    @endforeach
</select>
                    <button type="submit" class="btn btn-outline-success">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
                <a href="{{ route('notulensi.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-lg"></i> Tambah Notulensi
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No. Registrasi</th>
                            <th>Tanggal</th>
                            <th>Nama Pengadu</th>
                            <th>Perihal</th>
                            <th>Status</th>
                            <th>PIC</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($notulensis as $item)
                            <tr>
                                <td>{{ $item->no_registrasi }}</td>
                                <td>{{ $item->tanggal_waktu->format('d/m/Y H:i') }}</td>
                                <td>{{ $item->pengadu->nama ?? '-' }}</td>
                                <td>{{ Str::limit($item->perihal, 30) }}</td>
                                <td>
                                    <span class="badge {{ $item->status_badge }}">{{ $item->status_label }}</span>
                                </td>
                                <td>{{ $item->pic ?? '-' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('notulensi.show', $item) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('notulensi.edit', $item) }}" class="btn btn-sm btn-outline-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('notulensi.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">Belum ada data notulensi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $notulensis->links() }}
            </div>

        </div>
    </div>
</x-app-layout>