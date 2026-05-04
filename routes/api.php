<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Ini adalah jalur untuk perangkat IoT (Hardware) mengirim data ke server.
*/

Route::post('/update-trash', function (Request $request) {
    
    // Validasi data yang masuk dari sensor
    $validator = Validator::make($request->all(), [
        'id' => 'required|exists:trash_bins,id',
        'level' => 'required|integer|min:0|max:100',
    ]);

    if ($validator->fails()) {
        return response()->json(['status' => 'error', 'message' => 'Data tidak valid'], 400);
    }

    // Update data ke database berdasarkan ID tempat sampah
    $level = $request->level;
    $status = $level >= 90 ? 'Penuh' : ($level >= 60 ? 'Waspada' : 'Aman');

    DB::table('trash_bins')
        ->where('id', $request->id)
        ->update([
            'kapasitas_persen' => $level,
            'status' => $status,
            'updated_at' => now()
        ]);

    return response()->json([
        'status' => 'success',
        'message' => 'Node ' . $request->id . ' Berhasil Sinkronisasi',
        'data_received' => [
            'kapasitas' => $level . '%',
            'status_terkini' => $status
        ]
    ], 200);
});