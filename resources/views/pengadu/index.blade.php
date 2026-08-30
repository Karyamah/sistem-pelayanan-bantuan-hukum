<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold">Data Pengadu</h2>
    </x-slot>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-3">
                <form method="GET" class="d-flex gap-2">
                    <input type="text" name="cari" value="{{ request('cari') }}" class="form-control" placeholder="Cari nama atau NIK...">
                    <button type="submit" class="btn btn-outline-success">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
                <a href="{{ route('pengadu.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-lg"></i> Tambah Pengadu
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>No. Telepon</th>
                            <th>Alamat</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengadus as $pengadu)
                            <tr>
                                <td>{{ $loop->iteration + ($pengadus->currentPage() - 1) * $pengadus->perPage() }}</td>
                                <td>{{ $pengadu->nama }}</td>
                                <td>{{ $pengadu->nik }}</td>
                                <td>{{ $pengadu->no_telepon }}</td>
                                <td>{{ Str::limit($pengadu->alamat, 30) }}</td>
                                <td class="text-end">
                                    <a href="{{ route('pengadu.show', $pengadu) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('pengadu.edit', $pengadu) }}" class="btn btn-sm btn-outline-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('pengadu.destroy', $pengadu) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
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
                                <td colspan="6" class="text-center text-muted py-4">Belum ada data pengadu.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $pengadus->links() }}
            </div>

        </div>
    </div>
</x-app-layout>