@extends('dashboard.layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Detail Siswa</h3>
                    <div>
                            <button onclick="printDiv('printArea')" class="btn btn-success btn-sm">
                            <i class="fas fa-print"></i> Cetak
                            </button>
                        <a href="{{ route('siswa.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body" id="printArea">
                    <div class="row">
                        <!-- Foto -->
                        <div class="col-md-4 text-center">
                            @if($siswa->foto && file_exists(public_path('foto_siswa/' . $siswa->foto)))
                                <img src="{{ asset('foto_siswa/' . $siswa->foto) }}" 
                                     class="img-fluid rounded" 
                                     style="max-width: 200px; max-height: 200px; object-fit: cover;">
                            @else
                                <i class="fas fa-user-circle" style="font-size: 150px; color: #ccc;"></i>
                            @endif
                        </div>

                        <!-- Data Siswa -->
                        <div class="col-md-8">
                            <h4 class="text-center mb-3">DATA SISWA</h4>
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <th width="35%">Nama</th>
                                    <td>{{ $siswa->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Tempat Lahir</th>
                                    <td>{{ $siswa->tempat_lahir }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Lahir</th>
                                    <td>{{ $siswa->tanggal_lahir }}</td>
                                </tr>
                                <tr>
                                    <th>Umur</th>
                                    <td>{{ $siswa->umur }} Tahun</td>
                                </tr>
                                <tr>
                                    <th>NISN</th>
                                    <td>{{ $siswa->nisn }}</td>
                                </tr>
                                <tr>
                                    <th>NIK</th>
                                    <td>{{ $siswa->nik }}</td>
                                </tr>
                                <tr>
                                    <th>Kelas</th>
                                    <td>{{ $siswa->kelas }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>{{ $siswa->jenis_kelamin }}</td>
                                </tr>
                                <tr>
                                    <th>Agama</th>
                                    <td>{{ $siswa->agama }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>{{ $siswa->alamat }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <hr>

                    <!-- Data Orang Tua -->
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-center">Data Ayah</h5>
                            <table class="table table-bordered table-sm">
                                <tr>
                                    <th width="40%">Nama Ayah</th>
                                    <td>{{ $siswa->nama_ayah }}</td>
                                </tr>
                                <tr>
                                    <th>Pekerjaan Ayah</th>
                                    <td>{{ $siswa->pekerjaan_ayah }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-center">Data Ibu</h5>
                            <table class="table table-bordered table-sm">
                                <tr>
                                    <th width="40%">Nama Ibu</th>
                                    <td>{{ $siswa->nama_ibu }}</td>
                                </tr>
                                <tr>
                                    <th>Pekerjaan Ibu</th>
                                    <td>{{ $siswa->pekerjaan_ibu }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Data Lainnya -->
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="text-center">Data Lainnya</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">Jumlah Saudara</th>
                                    <td>{{ $siswa->jumlah_saudara }} Orang</td>
                                </tr>
                                <tr>
                                    <th>Asal Sekolah</th>
                                    <td>{{ $siswa->asal_sekolah }}</td>
                                </tr>
                                <tr>
                                    <th>Diterima Di Sekolah</th>
                                    <td>{{ $siswa->diterima_di_sekolah }}</td>
                                </tr>
                                <tr>
                                    <th>No Ijazah</th>
                                    <td>{{ $siswa->no_ijazah }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <div class="alert alert-info mt-3">
                        <i class="fas fa-info-circle"></i> Anda hanya dapat melihat data ini. Untuk mengedit data, hubungi Administrator.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .btn, .btn-group, .navbar, .sidebar, .card-header .btn {
        display: none !important;
    }
    .card-header {
        background-color: #f8f9fa !important;
        border-bottom: 2px solid #000 !important;
    }
    .container {
        margin: 0 !important;
        padding: 0 !important;
        max-width: 100% !important;
    }
    .card {
        border: 1px solid #000 !important;
        box-shadow: none !important;
    }
    img {
        max-width: 100% !important;
    }
    .alert {
        display: none !important;
    }
    @page {
        margin: 2cm;
    }
}
</style>

<script>
function printDiv(divId)
{
    let printContents = document.getElementById(divId).innerHTML;
    let originalContents = document.body.innerHTML;

    document.body.innerHTML = `
        <html>
            <head>
                <title>Data Siswa</title>

                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

                <style>
                    body{
                        margin:30px;
                        font-size:14px;
                    }

                    h4,h5{
                        text-align:center;
                        margin-bottom:20px;
                    }

                    table{
                        width:100%;
                        border-collapse:collapse;
                    }

                    table th,
                    table td{
                        border:1px solid #000;
                        padding:8px;
                    }

                    img{
                        max-width:180px;
                        max-height:180px;
                    }

                    .alert{
                        display:none;
                    }
                </style>

            </head>

            <body>

                ${printContents}

            </body>

        </html>
    `;

    window.print();

    document.body.innerHTML = originalContents;

    location.reload();
}
</script>

@endsection