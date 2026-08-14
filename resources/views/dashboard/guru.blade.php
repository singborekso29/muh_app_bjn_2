@extends('dashboard.layout')

@section('content')
<div class="container">
    <h1><i class="fas fa-chalkboard-teacher text-success"></i> Dashboard Guru</h1>
    <p class="text-muted">Selamat datang, {{ auth()->user()->name }}!</p>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-clipboard-check"></i> Absensi Hari Ini ({{ date('d-m-Y') }})</h5>
                </div>
                <div class="card-body">
                    @if(isset($myAbsensi) && $myAbsensi)
                        <div class="alert alert-success">
                            <h5>Status: <span class="badge bg-success">{{ ucfirst($myAbsensi->status) }}</span></h5>
                            <p>Jam Masuk: {{ $myAbsensi->jam_masuk ? date('H:i', strtotime($myAbsensi->jam_masuk)) : '-' }}</p>
                            <p>Jam Pulang: {{ $myAbsensi->jam_pulang ? date('H:i', strtotime($myAbsensi->jam_pulang)) : '-' }}</p>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <h5>Anda belum absen hari ini!</h5>
                            <a href="{{ route('absensi.create') }}" class="btn btn-primary">
                                <i class="fas fa-clipboard-check"></i> Absen Sekarang
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-info-circle"></i> Informasi</h5>
                </div>
                <div class="card-body">
                    <p><strong>Nama:</strong> {{ auth()->user()->name }}</p>
                    <p><strong>Role:</strong> <span class="badge bg-success">Guru</span></p>
                    <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                    <a href="{{ route('guru.profile') }}" class="btn btn-info">
                        <i class="fas fa-user"></i> Lihat Profil
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection