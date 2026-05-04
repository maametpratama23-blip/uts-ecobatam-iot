<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Network Nodes - EcoBatam IoT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f0f4f1; font-family: sans-serif; }
        .sidebar { background: #1b5e20; color: white; min-height: 100vh; padding: 30px 20px; position: fixed; width: 16.66%; }
        .main-content { margin-left: 16.66%; padding: 40px; }
        .nav-link { color: white; opacity: 0.7; padding: 12px; display: block; text-decoration: none; }
        .active { opacity: 1; background: rgba(255,255,255,0.1); border-radius: 10px; }
        .node-card { background: white; border-radius: 15px; border: none; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4 class="fw-bold mb-5 text-white">EcoBatam</h4>
        <nav>
            <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
            <a href="{{ route('nodes') }}" class="nav-link active">Network Nodes</a>
            <a href="{{ route('analytics') }}" class="nav-link">Device Analytics</a>
        </nav>
    </div>

    <div class="main-content">
        <h2 class="fw-bold mb-4">Hardware Node Management</h2>
        <div class="table-responsive bg-white p-4 rounded-4 shadow-sm">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Node ID</th>
                        <th>Location</th>
                        <th>IP Address</th>
                        <th>Signal Strength</th>
                        <th>Battery</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bins as $bin)
                    <tr>
                        <td><strong>NODE-0{{ $bin->id }}</strong></td>
                        <td>{{ $bin->lokasi }}</td>
                        <td><code>192.168.1.{{ 10 + $bin->id }}</code></td>
                        <td><span class="text-success">Excellent ( -45dBm )</span></td>
                        <td>88%</td>
                        <td><span class="badge bg-success">ONLINE</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>