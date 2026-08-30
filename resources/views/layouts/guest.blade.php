<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bantuan Hukum') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #14532d 0%, #166534 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .auth-card {
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            padding: 2.5rem;
            width: 100%;
            max-width: 420px;
        }
        .auth-brand {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .auth-brand i {
            font-size: 2.5rem;
            color: #15803d;
        }
        .auth-brand h4 {
            font-weight: 600;
            color: #14532d;
            margin-top: 0.5rem;
        }
        .btn-success {
            background-color: #15803d;
            border-color: #15803d;
        }
        .btn-success:hover {
            background-color: #14532d;
            border-color: #14532d;
        }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="auth-brand">
            <i class="bi bi-bank2"></i>
            <h4>Bantuan Hukum</h4>
            <p class="text-muted small mb-0">Biro Hukum Provinsi Jawa Barat</p>
        </div>

        {{ $slot }}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>