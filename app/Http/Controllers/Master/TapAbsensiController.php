<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\User;
use Illuminate\Http\Request;

class TapAbsensiController extends Controller
{
    // Halaman tap absensi (QR Code / RFID)
    public function index()
    {
        return view('absensi.tab');
    }

    // Proses tap / scan QR Code
    public function tap(Request $request)
    {
        $request->validate([
            'qr_data' => 'required|string'
        ]);

        // Cari user berdasarkan QR data
        $user = User::where('qr_code', $request->qr_data)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User tidak ditemukan!'
            ], 404);
        }

        $today = date('Y-m-d');
        $absensi = Absensi::where('user_id', $user->id)
            ->where('tanggal', $today)
            ->first();

        // Jika belum absen masuk
        if (!$absensi) {
            $absensi = Absensi::create([
                'role' => $user->role,
                'user_id' => $user->id,
                'nama' => $user->name,
                'tanggal' => $today,
                'jam_masuk' => date('H:i:s'),
                'status' => 'hadir',
                'metode' => 'tap',
                'device_id' => $request->device_id ?? 'web'
            ]);

            return response()->json([
                'status' => 'success',
                'message' => '✅ ' . $user->name . ' - Absen Masuk Berhasil!',
                'data' => [
                    'nama' => $user->name,
                    'role' => $user->role,
                    'jam' => date('H:i:s'),
                    'status' => 'Masuk'
                ]
            ]);
        }

        // Jika sudah absen masuk tapi belum pulang
        if (!$absensi->jam_pulang) {
            $absensi->update([
                'jam_pulang' => date('H:i:s')
            ]);

            return response()->json([
                'status' => 'success',
                'message' => '✅ ' . $user->name . ' - Absen Pulang Berhasil!',
                'data' => [
                    'nama' => $user->name,
                    'role' => $user->role,
                    'jam' => date('H:i:s'),
                    'status' => 'Pulang'
                ]
            ]);
        }

        // Jika sudah absen pulang
        return response()->json([
            'status' => 'warning',
            'message' => '⚠️ ' . $user->name . ' sudah absen hari ini!'
        ]);
    }

    // Tap menggunakan RFID
    public function tapRfid(Request $request)
    {
        $request->validate([
            'card_uid' => 'required|string'
        ]);

        $user = User::where('card_uid', $request->card_uid)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kartu tidak terdaftar!'
            ], 404);
        }

        return $this->tap(new Request([
            'qr_data' => $user->qr_code,
            'device_id' => $request->device_id ?? 'rfid_reader'
        ]));
    }

    // Generate QR Code untuk user (admin)
    public function generateQR($id)
    {
        $user = User::findOrFail($id);
        
        if (!$user->qr_code) {
            $user->qr_code = $user->id . '-' . $user->email;
            $user->save();
        }

        return view('absensi.qrcode', compact('user'));
    }
}