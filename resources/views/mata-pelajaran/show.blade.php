@extends('dashboard.layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Detail Mata Pelajaran</h3>
                    <a href="{{ route('mata-pelajaran.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th width="35%">Kode Mata Pelajaran</th>
                            <td>{{ $mataPelajaran->kode_mapel }}</td>
                        </tr>
                        <tr>
                            <th>Nama Mata Pelajaran</th>
                            <td>{{ $mataPelajaran->nama_mapel }}</td>
                        </tr>
                        <tr>
                            <th>Kelompok</th>
                            <td>{{ $mataPelajaran->kelompok ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Jam Pelajaran</th>
                            <td>{{ $mataPelajaran->jam_pelajaran }} JP / minggu</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($mataPelajaran->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Tidak Aktif</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
