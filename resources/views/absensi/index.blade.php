@extends('dashboard.layout')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Dashboard Absensi</h2>
        <div>
            <a href="{{ route('absensi.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Absen Sekarang
            </a>
            <a href="{{ route('absensi.laporan') }}" class="btn btn-info">
                <i class="fas fa-file-alt"></i> Laporan
            </a>
            <a href="{{ route('absensi.rekap') }}" class="btn btn-success">
                <i class="fas fa-chart-bar"></i> Rekap
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Statistik -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Siswa</h5>
                    <h2>{{ $totalSiswa }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Total Guru</h5>
                    <h2>{{ $totalGuru }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Total Karyawan</h5>
                    <h2>{{ $totalKaryawan }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-dark">
                <div class="card-body">
                    <h5 class="card-title">Hari Ini</h5>
                    <h6>{{ date('d-m-Y') }}</h6>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Status -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h6>Hadir</h6>
                    <h3>{{ $hadir }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h6>Izin</h6>
                    <h3>{{ $izin }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h6>Sakit</h6>
                    <h3>{{ $sakit }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h6>Alfa</h6>
                    <h3>{{ $alfa }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Absensi Hari Ini -->
    <div class="card">
        <div class="card-header">
            <h5><i class="fas fa-list"></i> Absensi Hari Ini ({{ date('d-m-Y') }})</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Jam Masuk</th>
                            <th>Jam Pulang</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($absensi as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>
                                @if($item->role == 'siswa')
                                    <span class="badge bg-primary">Siswa</span>
                                @elseif($item->role == 'guru')
                                    <span class="badge bg-success">Guru</span>
                                @else
                                    <span class="badge bg-info">Karyawan</span>
                                @endif
                            </td>
                            <td>{{ $item->jam_masuk ? date('H:i', strtotime($item->jam_masuk)) : '-' }}</td>
                            <td>{{ $item->jam_pulang ? date('H:i', strtotime($item->jam_pulang)) : '-' }}</td>
                            <td>
                                @if($item->status == 'hadir')
                                    <span class="badge bg-success">Hadir</span>
                                @elseif($item->status == 'izin')
                                    <span class="badge bg-warning">Izin</span>
                                @elseif($item->status == 'sakit')
                                    <span class="badge bg-info">Sakit</span>
                                @else
                                    <span class="badge bg-danger">Alfa</span>
                                @endif
                            </td>
                            <td>
                                @if(!$item->jam_pulang && $item->status == 'hadir')
                                    <a href="{{ route('absensi.pulang', $item->id) }}" class="btn btn-success btn-sm">
                                        <i class="fas fa-sign-out-alt"></i> Pulang
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada absensi hari ini</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection