<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold">Dashboard</h2>
    </x-slot>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-success bg-opacity-10 text-success rounded-3 p-3">
                        <i class="bi bi-people fs-3"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Total Pengadu</div>
                        <div class="fs-3 fw-semibold">{{ $totalPengadu }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-secondary bg-opacity-10 text-secondary rounded-3 p-3">
                        <i class="bi bi-file-earmark-plus fs-3"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Kasus Baru</div>
                        <div class="fs-3 fw-semibold">{{ $totalBaru }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3">
                        <i class="bi bi-hourglass-split fs-3"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Kasus Diproses</div>
                        <div class="fs-3 fw-semibold">{{ $totalDiproses }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-success bg-opacity-10 text-success rounded-3 p-3">
                        <i class="bi bi-check-circle fs-3"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Kasus Selesai</div>
                        <div class="fs-3 fw-semibold">{{ $totalSelesai }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-7">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h6 class="fw-semibold mb-3">Grafik Pengaduan per Bulan</h6>
                    <canvas id="chartPengaduan" height="250"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h6 class="fw-semibold mb-3">Notulensi Terbaru</h6>
                    @forelse ($notulensiTerbaru as $item)
                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                            <div>
                                <div class="small fw-semibold">{{ $item->pengadu->nama ?? '-' }}</div>
                                <div class="text-muted small">{{ Str::limit($item->perihal, 25) }}</div>
                            </div>
                            @if ($item->status == 'baru')
                                <span class="badge bg-secondary">Baru</span>
                            @elseif ($item->status == 'diproses')
                                <span class="badge bg-warning text-dark">Diproses</span>
                            @else
                                <span class="badge bg-success">Selesai</span>
                            @endif
                        </div>
                    @empty
                        <p class="text-muted small mb-0">Belum ada data notulensi.</p>
                    @endforelse
                    <a href="{{ route('notulensi.index') }}" class="btn btn-sm btn-outline-success w-100 mt-3">Lihat Semua</a>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script>
        const ctx = document.getElementById('chartPengaduan');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($bulanLabels) !!},
                datasets: [{
                    label: 'Jumlah Pengaduan',
                    data: {!! json_encode($bulanData) !!},
                    backgroundColor: '#15803d',
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
            }
        });
    </script>
    @endpush
</x-app-layout>