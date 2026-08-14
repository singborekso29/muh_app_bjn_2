@extends('dashboard.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card text-center">
                <div class="card-header">
                    <h5><i class="fas fa-qrcode text-primary"></i> QR Code Absensi</h5>
                </div>
                <div class="card-body">
                    <h6>{{ $user->name }}</h6>
                    <p class="text-muted">{{ $user->email }}</p>
                    <p><span class="badge bg-primary">{{ ucfirst($user->role) }}</span></p>

                    @php
                        use SimpleSoftwareIO\QrCode\Facades\QrCode;
                    @endphp

                    <div class="mt-3">
                        <img src="data:image/png;base64,{{ base64_encode(QrCode::size(300)->generate($user->qr_code)) }}" 
                             alt="QR Code" 
                             class="img-fluid"
                             style="max-width:250px;">
                    </div>

                    <p class="text-muted mt-3">Scan QR Code ini untuk absen</p>

                    <a href="{{ route('tap.index') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection