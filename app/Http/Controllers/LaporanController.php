<?php

namespace App\Http\Controllers;

use App\Models\Notulensi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Notulensi::with('pengadu');

        if ($request->filled('tanggal_awal')) {
            $query->whereDate('tanggal_waktu', '>=', $request->tanggal_awal);
        }

        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('tanggal_waktu', '<=', $request->tanggal_akhir);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $notulensis = $query->latest('tanggal_waktu')->get();

        return view('laporan.index', compact('notulensis'));
    }

    public function exportPdf(Request $request)
    {
        $query = Notulensi::with('pengadu');

        if ($request->filled('tanggal_awal')) {
            $query->whereDate('tanggal_waktu', '>=', $request->tanggal_awal);
        }

        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('tanggal_waktu', '<=', $request->tanggal_akhir);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $notulensis = $query->latest('tanggal_waktu')->get();

        $periode = 'Semua Periode';
        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $periode = \Carbon\Carbon::parse($request->tanggal_awal)->format('d/m/Y') . ' - ' . \Carbon\Carbon::parse($request->tanggal_akhir)->format('d/m/Y');
        }

        $pdf = Pdf::loadView('laporan.pdf', compact('notulensis', 'periode'))->setPaper('a4', 'landscape');

        return $pdf->download('laporan-bantuan-hukum-' . now()->format('Ymd-His') . '.pdf');
    }
}