<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Add New Node - EcoBatam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { background-color: #f0f4f1; font-family: 'Plus Jakarta Sans', sans-serif; }
        .sidebar { background: linear-gradient(180deg, #1b5e20 0%, #0a1a0b 100%); color: white; min-height: 100vh; padding: 30px 20px; position: fixed; width: 16.66%; }
        .main-content { margin-left: 16.66%; padding: 40px; }
        .form-card { background: white; border-radius: 24px; border: none; padding: 40px; }
        .btn-save { background: #2e7d32; border: none; border-radius: 12px; padding: 12px 30px; font-weight: bold; color: white; }
    </style>
</head>
<body>

<div class="container-fluid p-0">
    <div class="row g-0">
        <div class="col-md-2 sidebar">
            <h4 class="fw-bold mb-5">EcoBatam</h4>
            <nav class="nav flex-column">
                <a href="{{ route('dashboard') }}" class="nav-link text-white opacity-75 mb-3 text-decoration-none">Dashboard</a>
            </nav>
        </div>

        <div class="col-md-10 main-content">
            <div class="form-card shadow-sm mx-auto" style="max-width: 600px;">
                <h3 class="fw-bold mb-4 text-dark text-center">Registrasi Node Baru</h3>
                
                <form action="{{ route('trash.store') }}" method="POST">
                    @csrf {{-- Proteksi Token Keamanan Laravel --}}
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold">Nama Lokasi (Tanjung Uma)</label>
                        <input type="text" name="lokasi" class="form-control p-3" placeholder="Contoh: RT 04 / Lapangan Voli" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Kapasitas Awal (%)</label>
                        <input type="number" name="kapasitas_persen" class="form-control p-3" min="0" max="100" value="0" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-save shadow">SIMPAN DATA KE DATABASE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>