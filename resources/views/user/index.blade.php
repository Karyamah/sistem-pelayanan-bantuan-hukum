<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold mb-0">Manajemen User</h2>
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
                        <input type="text" name="cari" value="{{ request('cari') }}" class="form-control" placeholder="Cari nama atau email...">
                        <button type="submit" class="btn btn-outline-success">
                            <i class="bi bi-search"></i>
                        </button>
                        @if (request('cari'))
                            <a href="{{ route('user.index') }}" class="btn btn-outline-secondary" title="Reset">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        @endif
                    </div>
                </form>
                <a href="{{ route('user.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-lg"></i> Tambah User
                </a>
            </div>

            {{-- Tabel --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th class="text-end" style="width: 120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td class="text-muted">{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                                <td class="fw-semibold">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->role == 'admin')
                                        <span class="badge bg-success">Admin</span>
                                    @elseif($user->role == 'petugas')
                                        <span class="badge bg-primary">Petugas</span>
                                    @elseif($user->role == 'pimpinan')
                                        <span class="badge bg-warning text-dark">Pimpinan</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $user->role }}</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('user.edit', $user) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('user.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus user ini?')">
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
                                <td colspan="5" class="text-center text-muted py-5">
                                    <i class="bi bi-people fs-1 d-block mb-2"></i>
                                    Belum ada data user.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Info jumlah + pagination --}}
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mt-3">
                <small class="text-muted">
                    Menampilkan {{ $users->firstItem() ?? 0 }}–{{ $users->lastItem() ?? 0 }}
                    dari {{ $users->total() }} data
                </small>
                <div>
                    {{-- Memanggil custom pagination yang sudah kita buat --}}
                    {{ $users->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>