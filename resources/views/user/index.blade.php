<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold">Manajemen User</h2>
    </x-slot>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('user.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-lg"></i> Tambah User
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->role == 'admin')
                                        <span class="badge bg-success">Admin</span>
                                    @elseif ($user->role == 'petugas')
                                        <span class="badge bg-primary">Petugas</span>
                                    @else
                                        <span class="badge bg-secondary">Pimpinan</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('user.edit', $user) }}" class="btn btn-sm btn-outline-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    @if ($user->id !== auth()->id())
                                        <form action="{{ route('user.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus user ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Belum ada user.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $users->links() }}
            </div>

        </div>
    </div>
</x-app-layout>