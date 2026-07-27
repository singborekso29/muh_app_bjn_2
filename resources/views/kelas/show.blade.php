@extends('dashboard.layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0"><i class="fas fa-school text-primary"></i> Detail Kelas</h3>
                    <a href="{{ route('kelas.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th width="35%">Nama Kelas</th>
                            <td>{{ $kelas->nama_kelas }}</td>
                        </tr>
                        <tr>
                            <th>Tingkat</th>
                            <td>{{ $kelas->tingkat }}</td>
                        </tr>
                        <tr>
                            <th>Jurusan</th>
                            <td>{{ $kelas->jurusan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Wali Kelas</th>
                            <td>{{ $kelas->guru->nama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tahun Pelajaran</th>
                            <td>
                                @if($kelas->tahunPelajaran)
                                    {{ $kelas->tahunPelajaran->tahun }} - {{ $kelas->tahunPelajaran->semester }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Kapasitas</th>
                            <td>{{ $kelas->kapasitas }} siswa</td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td>{{ $kelas->keterangan ?? '-' }}</td>
                        </tr>
                    </table>

                    <div class="mt-3">
                        <a href="{{ route('kelas.edit', $kelas->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
