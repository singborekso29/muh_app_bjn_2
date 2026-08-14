<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\Auth;

class SiswaImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Siswa([
            'nama' => $row['nama'] ?? null,
            'nisn' => $row['nisn'] ?? null,
            'nik' => $row['nik'] ?? null,
            'kelas' => $row['kelas'] ?? null,
            'tempat_lahir' => $row['tempat_lahir'] ?? null,
            'tanggal_lahir' => $row['tanggal_lahir'] ?? null,
            'jenis_kelamin' => $row['jenis_kelamin'] ?? null,
            'umur' => $row['umur'] ?? null,
            'agama' => $row['agama'] ?? null,
            'nama_ayah' => $row['nama_ayah'] ?? null,
            'pekerjaan_ayah' => $row['pekerjaan_ayah'] ?? null,
            'nama_ibu' => $row['nama_ibu'] ?? null,
            'pekerjaan_ibu' => $row['pekerjaan_ibu'] ?? null,
            'jumlah_saudara' => $row['jumlah_saudara'] ?? 0,
            'asal_sekolah' => $row['asal_sekolah'] ?? null,
            'diterima_di_sekolah' => $row['diterima_di_sekolah'] ?? null,
            'no_ijazah' => $row['no_ijazah'] ?? null,
            'alamat' => $row['alamat'] ?? null,
            'user_id' => Auth::id(),
            'status_pembagian' => 'belum'
        ]);
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'nisn' => 'required|string|unique:siswas,nisn',
            'nik' => 'required|string|unique:siswas,nik',
            'kelas' => 'required|in:VII,VIII,IX',
            'tanggal_lahir' => 'required|date',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nama.required' => 'Kolom Nama wajib diisi',
            'nisn.required' => 'Kolom NISN wajib diisi',
            'nisn.unique' => 'NISN sudah terdaftar',
            'nik.required' => 'Kolom NIK wajib diisi',
            'nik.unique' => 'NIK sudah terdaftar',
            'kelas.required' => 'Kolom Kelas wajib diisi',
            'kelas.in' => 'Kelas harus VII, VIII, atau IX',
            'tanggal_lahir.required' => 'Kolom Tanggal Lahir wajib diisi',
            'tanggal_lahir.date' => 'Format Tanggal Lahir harus YYYY-MM-DD',
        ];
    }
}