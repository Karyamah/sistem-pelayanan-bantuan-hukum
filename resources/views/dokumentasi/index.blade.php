<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold">Dokumentasi Kegiatan</h2>
    </x-slot>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-3">
                <form method="GET" class="d-flex gap-2">
                    <input type="text" name="cari" value="{{ request('cari') }}" class="form-control" placeholder="Cari judul kegiatan...">
                    <button type="submit" class="btn btn-outline-success">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
                <a href="{{ route('dokumentasi.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-lg"></i> Tambah Dokumentasi
                </a>
            </div>

            <div class="row g-3">
                @forelse ($dokumentasis as $item)
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ asset('storage/' . $item->foto) }}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="{{ $item->judul_kegiatan }}">
                            <div class="card-body">
                                <h6 class="fw-semibold">{{ $item->judul_kegiatan }}</h6>
                                <p class="text-muted small mb-1">
                                    <i class="bi bi-calendar3"></i> {{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->format('d M Y') }}
                                </p>
                                <p class="small text-truncate">{{ $item->keterangan }}</p>
                            </div>
                            <div class="card-footer bg-white d-flex gap-2">
                                <a href="{{ route('dokumentasi.show', $item) }}" class="btn btn-sm btn-outline-primary flex-fill">
                                    <i class="bi bi-eye"></i> Lihat
                                </a>
                                <a href="{{ route('dokumentasi.edit', $item) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('dokumentasi.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin hapus dokumentasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted py-5">
                        Belum ada dokumentasi kegiatan.
                    </div>
                @endforelse
            </div>

            <div class="mt-3">
                {{ $dokumentasis->links() }}
            </div>

        </div>
    </div>
</x-app-layout>