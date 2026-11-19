<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold mb-0">Dokumentasi Kegiatan</h2>
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
                        <input type="text" name="cari" value="{{ request('cari') }}" class="form-control" placeholder="Cari judul kegiatan...">
                        <button type="submit" class="btn btn-outline-success">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
                <a href="{{ route('dokumentasi.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-lg"></i> Tambah Dokumentasi
                </a>
            </div>

            {{-- Grid dokumentasi --}}
            <div class="row g-3">
                @forelse ($dokumentasis as $item)
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="card h-100 shadow-sm border-0">
                            <img src="{{ asset('storage/' . $item->foto) }}"
                                 class="card-img-top"
                                 style="height: 180px; object-fit: cover;"
                                 alt="{{ $item->judul_kegiatan }}"
                                 loading="lazy">
                            <div class="card-body">
                                <h6 class="fw-semibold mb-1">{{ $item->judul_kegiatan }}</h6>
                                <p class="text-muted small mb-2">
                                    <i class="bi bi-calendar3"></i>
                                    {{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->format('d M Y') }}
                                </p>
                                <p class="small text-muted mb-0" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ $item->keterangan }}
                                </p>
                            </div>
                            <div class="card-footer bg-white border-0 d-flex gap-2 pt-0">
                                <a href="{{ route('dokumentasi.show', $item) }}" class="btn btn-sm btn-outline-primary flex-fill">
                                    <i class="bi bi-eye"></i> Lihat
                                </a>
                                <a href="{{ route('dokumentasi.edit', $item) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('dokumentasi.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus dokumentasi ini?')">
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
                        <i class="bi bi-images fs-1 d-block mb-2"></i>
                        Belum ada dokumentasi kegiatan.
                    </div>
                @endforelse
            </div>

            {{-- Pagination ringkas --}}
            <div class="mt-4">
                {{ $dokumentasis->links('vendor.pagination.bootstrap-5') }}
            </div>

        </div>
    </div>
</x-app-layout>