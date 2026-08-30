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
</x-app-layout>