<?php

namespace App\Http\Controllers;

use App\Models\Notulensi;
use App\Models\Pengadu;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPengadu = Pengadu::count();

        $perStatus = [];
        foreach (array_keys(Notulensi::STATUS) as $kode) {
            $perStatus[$kode] = Notulensi::where('status', $kode)->count();
        }

        $notulensiTerbaru = Notulensi::with('pengadu')->latest()->take(5)->get();

        $bulanLabels = [];
        $bulanData = [];
        for ($i = 5; $i >= 0; $i--) {
            $bulan = now()->startOfMonth()->subMonths($i);
            $bulanLabels[] = $bulan->translatedFormat('M Y');
            $bulanData[] = Notulensi::whereYear('created_at', $bulan->year)
                ->whereMonth('created_at', $bulan->month)
                ->count();
        }

        return view('dashboard', compact('totalPengadu', 'perStatus', 'notulensiTerbaru', 'bulanLabels', 'bulanData'));
    }
}