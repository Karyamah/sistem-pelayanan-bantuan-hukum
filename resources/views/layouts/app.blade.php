<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($header) ? strip_tags($header) . ' - ' : '' }}{{ config('app.name', 'Bantuan Hukum') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --sidebar-bg: #14532d;
            --sidebar-hover: #166534;
            --sidebar-active: #15803d;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f1f5f2;
        }
        #sidebar {
            width: 260px;
            min-height: 100vh;
            background-color: var(--sidebar-bg);
            position: fixed;
            top: 0;
            left: 0;
            transition: margin-left 0.3s;
            z-index: 1000;
        }
        #sidebar .brand {
            color: #fff;
            font-weight: 600;
            font-size: 1.1rem;
            padding: 1.25rem 1.25rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        #sidebar .nav-link {
            color: rgba(255,255,255,0.85);
            padding: 0.75rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.92rem;
            border-left: 3px solid transparent;
        }
        #sidebar .nav-link:hover {
            background-color: var(--sidebar-hover);
            color: #fff;
        }
        #sidebar .nav-link.active {
            background-color: var(--sidebar-active);
            color: #fff;
            border-left: 3px solid #bbf7d0;
        }
        #main-content {
            margin-left: 260px;
            transition: margin-left 0.3s;
        }
        #topbar {
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            padding: 0.85rem 1.5rem;
        }
        @media (max-width: 768px) {
            #sidebar { margin-left: -260px; }
            #sidebar.show { margin-left: 0; }
            #main-content { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div id="sidebar">
        <div class="brand">
            <i class="bi bi-bank2 me-2"></i> Bantuan Hukum
        </div>
        <nav class="nav flex-column py-2">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            @if (in_array(Auth::user()->role, ['admin', 'petugas']))
                <a href="{{ route('pengadu.index') }}" class="nav-link {{ request()->routeIs('pengadu.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Data Pengadu
                </a>
                <a href="{{ route('notulensi.index') }}" class="nav-link {{ request()->routeIs('notulensi.*') ? 'active' : '' }}">
                    <i class="bi bi-journal-text"></i> Notulensi
                </a>
                <a href="{{ route('dokumentasi.index') }}" class="nav-link {{ request()->routeIs('dokumentasi.*') ? 'active' : '' }}">
                    <i class="bi bi-images"></i> Dokumentasi Kegiatan
                </a>
            @endif

            <a href="{{ route('laporan.index') }}" class="nav-link {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-bar-graph"></i> Laporan
            </a>

            @if (Auth::user()->role == 'admin')
                <a href="{{ route('user.index') }}" class="nav-link {{ request()->routeIs('user.*') ? 'active' : '' }}">
                    <i class="bi bi-person-gear"></i> Manajemen User
                </a>
            @endif
        </nav>
    </div>

    <div id="main-content">
        <div id="topbar" class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <button class="btn btn-sm btn-outline-secondary d-md-none me-2" onclick="document.getElementById('sidebar').classList.toggle('show')">
                    <i class="bi bi-list"></i>
                </button>
                <h5 class="mb-0 fw-semibold text-dark">{!! $header ?? 'Dashboard' !!}</h5>
            </div>
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle fs-5"></i>
                    <span>{{ Auth::user()->name }}</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">Log Out</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <main class="p-4">
            {{ $slot }}
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>