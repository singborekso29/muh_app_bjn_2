@extends('dashboard.layout')

@section('content')
<div class="container">
    <h1><i class="fas fa-clipboard-check text-primary"></i> Absensi</h1>
    <hr>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('absensi.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label><i class="fas fa-user"></i> Nama</label>
                    <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
                </div>

                <div class="mb-3">
                    <label><i class="fas fa-tag"></i> Role</label>
                    <input type="text" class="form-control" value="{{ ucfirst(auth()->user()->role) }}" disabled>
                </div>

                <div class="mb-3">
                    <label><i class="fas fa-calendar"></i> Tanggal</label>
                    <input type="text" class="form-control" value="{{ date('d-m-Y') }}" disabled>
                </div>

                <div class="mb-3">
                    <label><i class="fas fa-check-circle"></i> Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-control" required>
                        <option value="hadir">Hadir</option>
                        <option value="izin">Izin</option>
                        <option value="sakit">Sakit</option>
                        <option value="alfa">Alfa</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label><i class="fas fa-sticky-note"></i> Catatan</label>
                    <textarea name="catatan" class="form-control" rows="3"></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-save"></i> Absen Sekarang
                    </button>
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-lg">
                        <i class="fas fa-arrow-left"></i> Batal
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection