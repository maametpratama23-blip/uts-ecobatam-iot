<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrashController extends Controller
{
    // 1. Menampilkan Dashboard Utama
    public function index()
    {
        $bins = DB::table('trash_bins')->orderBy('kapasitas_persen', 'desc')->get();
        return view('dashboard', compact('bins'));
    }

    // 2. Menampilkan Detail Node Hardware
    public function nodes()
    {
        $bins = DB::table('trash_bins')->get();
        return view('nodes', compact('bins'));
    }

    // 3. Menampilkan Halaman Analytics
    public function analytics()
    {
        return view('analytics');
    }

    // 4. Menampilkan Form Tambah Node Baru
    public function create()
    {
        return view('create_node');
    }

    // 5. Menyimpan Data Baru ke Database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'lokasi' => 'required|string|max:255',
            'kapasitas_persen' => 'required|integer|min:0|max:100',
        ]);

        // Menentukan status otomatis
        $status = 'Aman';
        if ($request->kapasitas_persen >= 90) {
            $status = 'Penuh';
        } elseif ($request->kapasitas_persen >= 60) {
            $status = 'Waspada';
        }

        // Insert ke database
        DB::table('trash_bins')->insert([
            'lokasi' => $request->lokasi,
            'kapasitas_persen' => $request->kapasitas_persen,
            'status' => $status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Node Baru Berhasil Ditambahkan ke Sistem!');
    }
}