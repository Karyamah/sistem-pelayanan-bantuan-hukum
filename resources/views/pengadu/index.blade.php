<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold mb-0">Data Pengaduan</h2>
    </x-slot>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            @endif

            {{-- Toolbar: search + tombol tambah --}}
            <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-3">
                <form method="GET" class="d-flex gap-2" style="max-width: 320px; width: 100%;">
                    <div class="input-group">
                        <input type="text" name="cari" value="{{ request('cari') }}" class="form-control" placeholder="Cari nama atau NIK...">
                        <button type="submit" class="btn btn-outline-success">
                            <i class="bi bi-search"></i>
                        </button>
                        @if (request('cari'))
                            <a href="{{ route('pengadu.index') }}" class="btn btn-outline-secondary" title="Reset">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        @endif
                    </div>
                </form>
                <a href="{{ route('pengadu.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-lg"></i> Tambah Pengaduan
                </a>
            </div>

            {{-- Tabel --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>No. Telepon</th>
                            <th>Alamat</th>
                            <th class="text-end" style="width: 140px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengadus as $pengadu)
                            <tr>
                                <td class="text-muted">{{ $loop->iteration + ($pengadus->currentPage() - 1) * $pengadus->perPage() }}</td>
                                <td class="fw-semibold">{{ $pengadu->nama }}</td>
                                <td><code>{{ $pengadu->nik }}</code></td>
                                <td>{{ $pengadu->no_telepon }}</td>
                                <td>{{ Str::limit($pengadu->alamat, 30) }}</td>
                                <td class="text-end">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('pengadu.show', $pengadu) }}" class="btn btn-sm btn-outline-primary" title="Lihat">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('pengadu.edit', $pengadu) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('pengadu.destroy', $pengadu) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    Belum ada data pengadu.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Info jumlah + pagination --}}
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mt-3">
                <small class="text-muted">
                    Menampilkan {{ $pengadus->firstItem() ?? 0 }}–{{ $pengadus->lastItem() ?? 0 }}
                    dari {{ $pengadus->total() }} data
                </small>
                <div>
                    {{ $pengadus->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>