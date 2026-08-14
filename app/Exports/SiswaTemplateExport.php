<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SiswaTemplateExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        // Contoh data template (1 baris contoh)
        return collect([
            [
                'Ahmad Fauzi',
                '1234567890',
                '1234567890123456',
                'VII',
                'Jakarta',
                '2010-01-01',
                'Laki-laki',
                '14',
                'Islam',
                'Budi Santoso',
                'PNS',
                'Siti Aminah',
                'IRT',
                '2',
                'SDN 01 Jakarta',
                '2024-07-01',
                'IJZ-001',
                'Jl. Mawar No. 1, Jakarta'
            ]
        ]);
    }

    public function headings(): array
    {
        return [
            'nama',
            'nisn',
            'nik',
            'kelas',
            'tempat_lahir',
            'tanggal_lahir',
            'jenis_kelamin',
            'umur',
            'agama',
            'nama_ayah',
            'pekerjaan_ayah',
            'nama_ibu',
            'pekerjaan_ibu',
            'jumlah_saudara',
            'asal_sekolah',
            'diterima_di_sekolah',
            'no_ijazah',
            'alamat'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }
}