<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold">Dashboard</h2>
    </x-slot>

    {{-- STATISTIK --}}
    <div class="row row-cols-2 row-cols-md-3 row-cols-xl-6 g-3 mb-4">

        {{-- TOTAL PENGADUAN --}}
        <div class="col">
            <div class="card border-0 shadow-sm h-100 dashboard-stat-card">
                <div class="card-body text-center d-flex flex-column justify-content-center">

                    <div class="dashboard-stat-icon mx-auto mb-2">
                        <i class="bi bi-people"></i>
                    </div>

                    <div class="text-muted small dashboard-stat-label">
                        Total Pengaduan
                    </div>

                    <div class="fs-3 fw-semibold">
                        {{ $totalPengadu }}
                    </div>

                </div>
            </div>
        </div>


        {{-- STATUS --}}
        @foreach (\App\Models\Notulensi::STATUS as $kode => $info)

            <div class="col">
                <div class="card border-0 shadow-sm h-100 dashboard-stat-card">

                    <div class="card-body text-center d-flex flex-column justify-content-center">

                        <div class="dashboard-stat-icon mx-auto mb-2">
                            <i class="bi {{ $info['icon'] }}"></i>
                        </div>

                        <div class="text-muted small dashboard-stat-label">
                            {{ $info['short'] }}
                        </div>

                        <div class="fs-3 fw-semibold">
                            {{ $perStatus[$kode] ?? 0 }}
                        </div>

                    </div>

                </div>
            </div>

        @endforeach

    </div>


    {{-- GRAFIK & NOTULENSI TERBARU --}}
    <div class="row g-3">

        {{-- GRAFIK --}}
        <div class="col-md-7">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <h6 class="fw-semibold mb-3">
                        Grafik Pengaduan per Bulan
                    </h6>

                    <canvas id="chartPengaduan" height="250"></canvas>

                </div>

            </div>

        </div>


        {{-- NOTULENSI TERBARU --}}
        <div class="col-md-5">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <h6 class="fw-semibold mb-3">
                        Notulensi Terbaru
                    </h6>


                    @forelse ($notulensiTerbaru as $item)

                        <div class="d-flex justify-content-between align-items-start border-bottom py-2 gap-2">

                            <div class="min-width-0">

                                <div class="small fw-semibold">
                                    {{ $item->pengadu->nama ?? '-' }}
                                </div>

                                <div class="text-muted small">
                                    {{ Str::limit($item->perihal, 25) }}
                                </div>

                            </div>


                            <span class="badge {{ $item->status_badge }} text-wrap text-center">
                                {{ $item->status_label }}
                            </span>

                        </div>

                    @empty

                        <p class="text-muted small mb-0">
                            Belum ada data notulensi.
                        </p>

                    @endforelse


                    @if (in_array(Auth::user()->role, ['admin', 'petugas']))

                        <a href="{{ route('pengadu.index') }}"
                            class="btn btn-sm btn-outline-success w-100 mt-3">

                            Lihat Semua

                        </a>

                    @endif

                </div>

            </div>

        </div>

    </div>


    {{-- CSS DASHBOARD --}}
    <style>

        /* Kartu statistik bagian atas */
        .dashboard-stat-card {
            min-height: 180px;
            overflow: hidden;
        }

        /* Icon statistik */
        .dashboard-stat-icon {
            width: 52px;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;

            background-color: rgba(25, 135, 84, 0.10);
            color: #198754;

            border-radius: 12px;

            flex-shrink: 0;
        }

        .dashboard-stat-icon i {
            font-size: 1.5rem;
        }

        /* Tulisan status */
        .dashboard-stat-label {
            min-height: 48px;

            display: flex;
            align-items: center;
            justify-content: center;

            line-height: 1.3;

            padding: 0 4px;

            overflow-wrap: anywhere;
            word-break: normal;
        }

        /* Supaya isi Notulensi tidak mendorong kartu */
        .min-width-0 {
            min-width: 0;
        }

        /* Badge status di Notulensi terbaru */
        .badge.text-wrap {
            white-space: normal;
            line-height: 1.2;
            max-width: 55%;
        }

        /* Tampilan layar kecil */
        @media (max-width: 767.98px) {

            .dashboard-stat-card {
                min-height: 160px;
            }

            .dashboard-stat-label {
                min-height: 42px;
            }

        }

    </style>


    {{-- CHART --}}
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

                    plugins: {
                        legend: {
                            display: false
                        }
                    },

                    scales: {

                        y: {
                            beginAtZero: true,

                            ticks: {
                                stepSize: 1
                            }

                        }

                    }

                }

            });

        </script>

    @endpush

</x-app-layout>