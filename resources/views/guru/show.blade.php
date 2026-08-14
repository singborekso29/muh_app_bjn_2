@extends('dashboard.layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">

            <div class="card">

                {{-- HEADER --}}
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Detail Guru</h3>

                    <div>
                        <a href="{{ route('guru.cetak-pdf', $guru->id) }}"
                           class="btn btn-danger btn-sm"
                           target="_blank">
                            <i class="fas fa-file-pdf"></i>
                            Cetak PDF
                        </a>

                        <button onclick="window.print()"
                                class="btn btn-success btn-sm">
                            <i class="fas fa-print"></i>
                            Cetak
                        </button>

                        <a href="{{ route('guru.index') }}"
                           class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i>
                            Kembali
                        </a>
                    </div>
                </div>

                {{-- BODY --}}
                <div class="card-body" id="printArea">

                    <div class="row">

                        {{-- FOTO GURU --}}
                        <div class="col-md-4 text-center">

                            @if($guru->foto && file_exists(public_path('foto_guru/' . $guru->foto)))

                                <img src="{{ asset('foto_guru/' . $guru->foto) }}"
                                     class="img-fluid rounded"
                                     style="
                                        width: 200px;
                                        height: 250px;
                                        object-fit: cover;
                                     "
                                     alt="Foto {{ $guru->nama }}">

                            @else

                                <i class="fas fa-user-circle"
                                   style="
                                        font-size: 150px;
                                        color: #ccc;
                                   ">
                                </i>

                                <p class="text-muted mt-2">
                                    Foto belum tersedia
                                </p>

                            @endif

                        </div>


                        {{-- DATA GURU --}}
                        <div class="col-md-8">

                            <h4 class="text-center mb-3">
                                DATA GURU
                            </h4>

                            <table class="table table-bordered">

                                <tr>
                                    <th width="35%">Nama</th>
                                    <td>{{ $guru->nama }}</td>
                                </tr>

                                <tr>
                                    <th>NIP</th>
                                    <td>{{ $guru->nip }}</td>
                                </tr>

                                <tr>
                                    <th>Tempat Lahir</th>
                                    <td>{{ $guru->tempat_lahir }}</td>
                                </tr>

                                <tr>
                                    <th>Tanggal Lahir</th>
                                    <td>{{ $guru->tanggal_lahir }}</td>
                                </tr>

                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>{{ $guru->jenis_kelamin }}</td>
                                </tr>

                                <tr>
                                    <th>Agama</th>
                                    <td>{{ $guru->agama }}</td>
                                </tr>

                                <tr>
                                    <th>Pendidikan Terakhir</th>
                                    <td>{{ $guru->pendidikan_terakhir }}</td>
                                </tr>

                                <tr>
                                    <th>Jurusan</th>
                                    <td>{{ $guru->jurusan }}</td>
                                </tr>

                                <tr>
                                    <th>Status Kepegawaian</th>
                                    <td>{{ $guru->status_kepegawaian }}</td>
                                </tr>

                                <tr>
                                    <th>Mata Pelajaran</th>
                                    <td>{{ $guru->mapel }}</td>
                                </tr>

                                <tr>
                                    <th>No. Telepon</th>
                                    <td>{{ $guru->no_telepon }}</td>
                                </tr>

                                <tr>
                                    <th>Alamat</th>
                                    <td>{{ $guru->alamat }}</td>
                                </tr>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
</div>


{{-- STYLE CETAK --}}
<style>

@media print {

    /* Hilangkan tombol */
    .btn,
    .btn-group {
        display: none !important;
    }

    /* Hilangkan navbar */
    .navbar,
    .sidebar {
        display: none !important;
    }

    /* Hilangkan header kartu */
    .card-header {
        display: none !important;
    }

    /* Hilangkan background */
    body {
        background: white !important;
    }

    .container {
        width: 100% !important;
        max-width: 100% !important;

        margin: 0 !important;
        padding: 0 !important;
    }

    .row {
        margin: 0 !important;
    }

    .card {
        border: none !important;
        box-shadow: none !important;
    }

    .card-body {
        padding: 0 !important;
    }

    table {
        width: 100% !important;
        border-collapse: collapse !important;
    }

    th,
    td {
        border: 1px solid #000 !important;
        padding: 6px !important;
    }

    img {
        max-width: 150px !important;
        max-height: 180px !important;
    }

    @page {
        size: A4 portrait;
        margin: 1.5cm;
    }
}

</style>

@endsection