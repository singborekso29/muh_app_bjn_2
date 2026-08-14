@extends('dashboard.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0"><i class="fas fa-clock text-primary"></i> Detail Jadwal</h3>
                    <div>
                        <a href="{{ route('jadwal.edit', $jadwal->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('jadwal.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th width="35%"><i class="fas fa-school"></i> Kelas</th>
                            <td>{{ $jadwal->kelas ? $jadwal->kelas->nama_kelas : '-' }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-book"></i> Mata Pelajaran</th>
                            <td>{{ $jadwal->mataPelajaran ? $jadwal->mataPelajaran->nama_mapel : '-' }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-chalkboard-teacher"></i> Guru</th>
                            <td>{{ $jadwal->guru ? $jadwal->guru->nama : '-' }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-calendar-day"></i> Hari</th>
                            <td>{{ $jadwal->hari }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-clock"></i> Jam</th>
                            <td>{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-door-open"></i> Ruangan</th>
                            <td>{{ $jadwal->ruangan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-calendar-alt"></i> Tahun Pelajaran</th>
                            <td>{{ $jadwal->tahunPelajaran ? $jadwal->tahunPelajaran->tahun . ' - ' . $jadwal->tahunPelajaran->semester : '-' }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-info-circle"></i> Keterangan</th>
                            <td>{{ $jadwal->keterangan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-clock"></i> Dibuat</th>
                            <td>{{ $jadwal->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-clock"></i> Diupdate</th>
                            <td>{{ $jadwal->updated_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection