<?php

namespace App\Http\Controllers;
use App\Models\Notulensi;
use App\Models\Pengadu;
use Illuminate\Http\Request;
class DashboardController extends Controller
{
    public function index()
    {
        $totalPengadu = Pengadu::count();
        $totalDiproses = Notulensi::where('status', 'diproses')->count();
        $totalSelesai = Notulensi::where('status', 'selesai')->count();
        $totalBaru = Notulensi::where('status', 'baru')->count();

        $notulensiTerbaru = Notulensi::with('pengadu')->latest()->take(5)->get();

        $bulanLabels = [];
        $bulanData = [];
        for ($i = 5; $i >= 0; $i--) {
            $bulan = now()->subMonths($i);
            $bulanLabels[] = $bulan->translatedFormat('M Y');
            $bulanData[] = Notulensi::whereYear('created_at', $bulan->year)
                ->whereMonth('created_at', $bulan->month)
                ->count();
        }

        return view('dashboard', compact(
            'totalPengadu',
            'totalDiproses',
            'totalSelesai',
            'totalBaru',
            'notulensiTerbaru',
            'bulanLabels',
            'bulanData'
        ));
    }
}