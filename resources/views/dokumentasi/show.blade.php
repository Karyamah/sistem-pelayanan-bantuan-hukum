<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold">Detail Dokumentasi</h2>
    </x-slot>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <img src="{{ asset('storage/' . $dokumentasi->foto) }}" class="img-fluid rounded mb-3" style="max-height: 400px; width: 100%; object-fit: cover;">

            <h4 class="fw-semibold">{{ $dokumentasi->judul_kegiatan }}</h4>
            <p class="text-muted">
                <i class="bi bi-calendar3"></i> {{ \Carbon\Carbon::parse($dokumentasi->tanggal_kegiatan)->format('d F Y') }}
                @if ($dokumentasi->user)
                    &nbsp;|&nbsp; <i class="bi bi-person"></i> {{ $dokumentasi->user->name }}
                @endif
            </p>
            <p>{{ $dokumentasi->keterangan ?? 'Tidak ada keterangan.' }}</p>

            <div class="d-flex gap-2 mt-3">
                <a href="{{ route('dokumentasi.edit', $dokumentasi) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="{{ route('dokumentasi.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>

        </div>
    </div>
</x-app-layout>