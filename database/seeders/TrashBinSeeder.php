<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrashBinSeeder extends Seeder
{
    public function run()
    {
        // Menghapus data lama agar tidak duplikat saat dijalankan ulang
        DB::table('trash_bins')->truncate();

        DB::table('trash_bins')->insert([
            [
                'lokasi' => 'Tanjung Uma - Dermaga', 
                'kapasitas_persen' => 25, 
                'status' => 'Aman', 
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'lokasi' => 'Tanjung Uma - Pasar Lama', 
                'kapasitas_persen' => 85, 
                'status' => 'Waspada', 
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'lokasi' => 'Tanjung Uma - Pesisir Bakau', 
                'kapasitas_persen' => 95, 
                'status' => 'Penuh', 
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}