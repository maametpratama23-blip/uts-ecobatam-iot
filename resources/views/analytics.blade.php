<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics - EcoBatam IoT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #2e7d32; --dark: #0a1a0b; --bg: #f0f4f1; }
        body { background-color: var(--bg); font-family: 'Plus Jakarta Sans', sans-serif; }
        .sidebar { background: linear-gradient(180deg, #1b5e20 0%, #0a1a0b 100%); color: white; min-height: 100vh; padding: 30px 20px; position: fixed; width: 16.66%; }
        .main-content { margin-left: 16.66%; padding: 40px; }
        .nav-link { color: rgba(255,255,255,0.7); border-radius: 12px; margin-bottom: 10px; transition: 0.3s; padding: 12px 20px; text-decoration: none; display: block; }
        .nav-link:hover, .nav-link.active { background: rgba(255,255,255,0.1); color: white; }
        .analysis-card { background: white; border-radius: 24px; border: none; padding: 40px; text-center: center; }
        .icon-box { background: #e8f5e9; color: #2e7d32; width: 80px; height: 80px; border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; }
    </style>
</head>
<body>

<div class="container-fluid p-0">
    <div class="row g-0">
        <!-- Sidebar Tetap Ada Agar Navigasi Berfungsi -->
        <div class="col-md-2 sidebar shadow-lg">
            <h4 class="fw-bold mb-5 text-white">EcoBatam <small class="d-block text-success" style="font-size: 10px;">IOT SYSTEM</small></h4>
            <nav class="nav flex-column">
                <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                <a href="{{ route('nodes') }}" class="nav-link">Network Nodes</a>
                <a href="{{ route('analytics') }}" class="nav-link active">Device Analytics</a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 main-content text-center">
            <div class="analysis-card shadow-sm mt-5">
                <div class="icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-graph-up-arrow" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0Zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5Z"/>
                    </svg>
                </div>
                <h2 class="fw-bold text-dark">Data Analytics Engine</h2>
                <p class="text-muted mx-auto" style="max-width: 500px;">
                    Modul ini sedang dalam tahap sinkronisasi dengan dataset lingkungan Batam. 
                    Fitur **Predictive Waste Collection** menggunakan Machine Learning akan segera hadir untuk mengoptimalkan jadwal pengangkutan sampah di Tanjung Uma.
                </p>
                <div class="progress mt-4 mx-auto" style="height: 10px; max-width: 300px; border-radius: 10px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 65%"></div>
                </div>
                <small class="text-muted d-block mt-2">Environment Model Loading: 65%</small>
                
                <a href="{{ route('dashboard') }}" class="btn btn-success mt-4 px-5 py-3 shadow" style="border-radius: 15px; font-weight: bold;">
                    KEMBALI KE DASHBOARD
                </a>
            </div>
        </div>
    </div>
</div>

</body>
</html>