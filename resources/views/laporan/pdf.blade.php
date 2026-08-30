<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Bantuan Hukum</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; }
        h2 { text-align: center; margin-bottom: 0; color: #14532d; }
        p.sub { text-align: center; margin-top: 4px; color: #555; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #999; padding: 6px 8px; text-align: left; }
        th { background-color: #15803d; color: #fff; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        .footer { margin-top: 20px; font-size: 10px; text-align: right; color: #777; }
    </style>
</head>
<body>
    <h2>Laporan Pelayanan Bantuan Hukum</h2>
    <p class="sub">Biro Hukum Pemerintah Provinsi Jawa Barat | Periode: {{ $periode }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No. Registrasi</th>
                <th>Tanggal</th>
                <th>Nama Pengadu</th>
                <th>Perihal</th>
                <th>PIC</th>
                <th>Notulis</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($notulensis as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->no_registrasi }}</td>
                    <td>{{ $item->tanggal_waktu->format('d/m/Y') }}</td>
                    <td>{{ $item->pengadu->nama ?? '-' }}</td>
                    <td>{{ $item->perihal }}</td>
                    <td>{{ $item->pic ?? '-' }}</td>
                    <td>{{ $item->notulis ?? '-' }}</td>
                    <td>{{ ucfirst($item->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center;">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p class="footer">Dicetak pada {{ now()->format('d F Y, H:i') }} WIB</p>
</body>
</html>