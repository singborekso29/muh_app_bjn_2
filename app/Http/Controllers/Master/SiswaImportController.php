<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Imports\SiswaImport;
use App\Exports\SiswaTemplateExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class SiswaImportController extends Controller
{
    public function index()
    {
        return view('siswa.import');
    }

    public function downloadTemplate()
    {
        return Excel::download(new SiswaTemplateExport, 'template_siswa.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:5120'
        ]);

        try {
            Excel::import(new SiswaImport, $request->file('file'));
            return redirect()
                ->route('siswa.index')
                ->with('success', 'Data siswa berhasil diimport!');
        } catch (\Exception $e) {
            return redirect()
                ->route('siswa.import')
                ->with('error', 'Import gagal: ' . $e->getMessage());
        }
    }
}