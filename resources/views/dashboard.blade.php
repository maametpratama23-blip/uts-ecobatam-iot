<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoBatam - Premium IoT Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #059669; --dark-green: #064e3b; --bg: #f8fafc; }
        body { background-color: var(--bg); font-family: 'Inter', sans-serif; color: #1e293b; }
        
        /* Sidebar Styles */
        .sidebar { background: var(--dark-green); color: white; min-height: 100vh; padding: 40px 24px; position: fixed; width: 280px; z-index: 100; }
        .nav-link { color: rgba(255,255,255,0.6); border-radius: 12px; margin-bottom: 8px; padding: 14px 20px; transition: 0.3s; text-decoration: none; display: flex; align-items: center; }
        .nav-link:hover, .nav-link.active { background: rgba(255,255,255,0.1); color: white; }
        .nav-link.active { background: var(--primary); color: white; box-shadow: 0 10px 15px -3px rgba(5, 150, 105, 0.4); }

        /* Main Content */
        .main-content { margin-left: 280px; padding: 60px; }
        
        /* Header & Buttons */
        .page-header { margin-bottom: 48px; }
        .btn-expert { border-radius: 16px; padding: 14px 28px; font-weight: 600; transition: 0.3s; border: none; }
        .btn-add { background: white; color: var(--primary); border: 2px solid var(--primary); }
        .btn-add:hover { background: var(--primary); color: white; }
        .btn-sync { background: var(--primary); color: white; box-shadow: 0 10px 15px -3px rgba(5, 150, 105, 0.3); }
        .btn-sync:hover { background: var(--dark-green); transform: translateY(-2px); }

        /* Glass Card Styles */
        .node-card { background: white; border: 1px solid rgba(226, 232, 240, 0.8); border-radius: 32px; padding: 32px; transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1); height: 100%; position: relative; }
        .node-card:hover { transform: translateY(-12px); box-shadow: 0 40px 60px -15px rgba(15, 23, 42, 0.1); border-color: var(--primary); }
        
        /* Chart Labels */
        .chart-box { position: relative; width: 180px; margin: 0 auto 24px; }
        .chart-percentage { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 2rem; font-weight: 800; }
        
        .status-pill { border-radius: 100px; padding: 6px 16px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; display: inline-block; }
        .status-full { background: #fee2e2; color: #991b1b; }
        .status-warn { background: #fef3c7; color: #92400e; }
        .status-safe { background: #dcfce7; color: #166534; }

        .location-title { font-size: 1.25rem; font-weight: 700; color: #0f172a; margin-bottom: 8px; }
        .timestamp { font-size: 0.85rem; color: #64748b; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="d-flex align-items-center mb-5 px-2">
        <div style="background: var(--primary); width: 40px; height: 40px; border-radius: 12px; display: grid; place-items: center; margin-right: 16px;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
        </div>
        <h4 class="fw-800 m-0 text-white tracking-tighter">EcoBatam</h4>
    </div>
    
    <nav>
        <a href="{{ route('dashboard') }}" class="nav-link active">Dashboard</a>
        <a href="{{ route('nodes') }}" class="nav-link">Network Nodes</a>
        <a href="{{ route('analytics') }}" class="nav-link">Analytics</a>
        <a href="#" class="nav-link mt-5">Settings</a>
    </nav>
</div>

<div class="main-content">
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 20px; padding: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="page-header d-flex justify-content-between align-items-end">
        <div>
            <h1 class="fw-800 display-6">Live Monitoring</h1>
            <p class="text-muted fw-medium m-0">Tanjung Uma Smart Cluster Node Control</p>
        </div>
        <div class="d-flex gap-3">
            <a href="{{ route('trash.create') }}" class="btn-expert btn-add text-decoration-none">Add New Node</a>
            <button class="btn-expert btn-sync" onclick="window.location.reload()">Sync System</button>
        </div>
    </div>

    <div class="row g-4">
        @foreach($bins as $bin)
        @php
            $color = '#10b981'; $pill = 'status-safe';
            if($bin->kapasitas_persen >= 90) { $color = '#ef4444'; $pill = 'status-full'; }
            elseif($bin->kapasitas_persen >= 60) { $color = '#f59e0b'; $pill = 'status-warn'; }
        @endphp
        <div class="col-xl-4 col-md-6">
            <div class="node-card">
                <div class="chart-box">
                    <canvas id="chart-{{ $bin->id }}"></canvas>
                    <div class="chart-percentage" style="color: {{ $color }}">{{ $bin->kapasitas_persen }}%</div>
                </div>
                
                <div class="text-center">
                    <div class="status-pill {{ $pill }} mb-3">{{ $bin->status }}</div>
                    <h3 class="location-title">{{ $bin->lokasi }}</h3>
                    <div class="d-flex justify-content-center align-items-center gap-3 mt-4">
                        <div class="text-start">
                            <span class="d-block text-muted small fw-bold text-uppercase">Node ID</span>
                            <span class="fw-600">ID-0{{ $bin->id }}</span>
                        </div>
                        <div style="width: 1px; height: 30px; background: #e2e8f0;"></div>
                        <div class="text-start">
                            <span class="d-block text-muted small fw-bold text-uppercase">Uptime</span>
                            <span class="fw-600">{{ date('H:i') }} WIB</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    @foreach($bins as $bin)
    @php
        $color = '#10b981'; 
        if($bin->kapasitas_persen >= 90) $color = '#ef4444';
        elseif($bin->kapasitas_persen >= 60) $color = '#f59e0b';
    @endphp
    new Chart(document.getElementById('chart-{{ $bin->id }}'), {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [{{ $bin->kapasitas_persen }}, {{ 100 - $bin->kapasitas_persen }}],
                backgroundColor: ['{{ $color }}', '#f1f5f9'],
                borderWidth: 0,
                borderRadius: 15
            }]
        },
        options: {
            cutout: '85%',
            animation: { duration: 2500, easing: 'easeOutQuart' },
            plugins: { tooltip: { enabled: false } }
        }
    });
    @endforeach
</script>
</body>
</html>