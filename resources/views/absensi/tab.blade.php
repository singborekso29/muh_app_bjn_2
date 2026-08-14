@extends('dashboard.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <h1><i class="fas fa-id-card text-primary"></i> Absensi Tap / QR Code</h1>
            <hr>

            <!-- Tab Navigation -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="qr-tab" data-bs-toggle="tab" data-bs-target="#qr" type="button" role="tab">
                        <i class="fas fa-qrcode"></i> Scan QR Code
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="manual-tab" data-bs-toggle="tab" data-bs-target="#manual" type="button" role="tab">
                        <i class="fas fa-keyboard"></i> Manual Input
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="rfid-tab" data-bs-toggle="tab" data-bs-target="#rfid" type="button" role="tab">
                        <i class="fas fa-id-card"></i> RFID / Tap
                    </button>
                </li>
            </ul>

            <div class="tab-content mt-3" id="myTabContent">

                <!-- Tab 1: QR Code Scanner -->
                <div class="tab-pane fade show active" id="qr" role="tabpanel">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5><i class="fas fa-qrcode text-primary"></i> Scan QR Code</h5>
                            <p class="text-muted">Arahkan kamera ke QR Code untuk absen</p>

                            <div id="reader" style="width:100%; max-width:400px; margin:0 auto;"></div>

                            <div class="mt-3">
                                <input type="text" id="qr-input" class="form-control" placeholder="Atau masukkan kode QR manual" style="max-width:400px; margin:0 auto;">
                                <button class="btn btn-primary mt-2" onclick="processQR()">
                                    <i class="fas fa-check"></i> Proses
                                </button>
                            </div>

                            <div id="qr-result" class="mt-3"></div>
                        </div>
                    </div>
                </div>

                <!-- Tab 2: Manual Input -->
                <div class="tab-pane fade" id="manual" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <h5><i class="fas fa-keyboard text-warning"></i> Manual Input</h5>
                            <p class="text-muted">Masukkan kode QR atau ID user</p>

                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label>Kode QR / ID User</label>
                                        <input type="text" id="manual-input" class="form-control" placeholder="Contoh: 1-admin@sekolah.com">
                                    </div>
                                    <button class="btn btn-primary" onclick="processManual()">
                                        <i class="fas fa-check"></i> Proses Absen
                                    </button>
                                </div>
                            </div>

                            <div id="manual-result" class="mt-3"></div>
                        </div>
                    </div>
                </div>

                <!-- Tab 3: RFID / Tap -->
                <div class="tab-pane fade" id="rfid" role="tabpanel">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5><i class="fas fa-id-card text-success"></i> RFID / Tap Card</h5>
                            <p class="text-muted">Tempelkan kartu RFID ke reader</p>

                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i>
                                Pastikan kartu RFID sudah terdaftar di sistem
                            </div>

                            <div class="mb-3">
                                <input type="text" id="rfid-input" class="form-control" placeholder="Masukkan UID kartu" style="max-width:400px; margin:0 auto;">
                                <button class="btn btn-success mt-2" onclick="processRFID()">
                                    <i class="fas fa-id-card"></i> Tap
                                </button>
                            </div>

                            <div id="rfid-result" class="mt-3"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- QR Code Scanner Library -->
<script src="https://cdn.jsdelivr.net/npm/@zxing/browser@0.1.1/index.min.js"></script>

<script>
// ============================================
// QR CODE SCANNER
// ============================================
let scanner = null;

document.addEventListener('DOMContentLoaded', function() {
    // Inisialisasi QR Scanner
    const codeReader = new ZXing.BrowserMultiFormatReader();
    const videoElement = document.getElementById('reader');

    if (videoElement) {
        codeReader.decodeFromVideoDevice(null, videoElement, (result, err) => {
            if (result) {
                document.getElementById('qr-input').value = result.text;
                processQR();
            }
        });
    }
});

// ============================================
// FUNGSI PROSES ABSEN
// ============================================

// Proses QR Code
function processQR() {
    const qrData = document.getElementById('qr-input').value.trim();
    if (!qrData) {
        showResult('qr-result', 'warning', 'Masukkan kode QR!');
        return;
    }
    tapAbsensi('qr-result', { qr_data: qrData });
}

// Proses Manual
function processManual() {
    const input = document.getElementById('manual-input').value.trim();
    if (!input) {
        showResult('manual-result', 'warning', 'Masukkan kode QR / ID user!');
        return;
    }
    tapAbsensi('manual-result', { qr_data: input });
}

// Proses RFID
function processRFID() {
    const uid = document.getElementById('rfid-input').value.trim();
    if (!uid) {
        showResult('rfid-result', 'warning', 'Masukkan UID kartu!');
        return;
    }
    tapAbsensi('rfid-result', { card_uid: uid }, 'rfid');
}

// ============================================
// FUNGSI API
// ============================================

function tapAbsensi(resultId, data, type = 'tap') {
    const url = type === 'rfid' ? '{{ route("tap.rfid") }}' : '{{ route("tap.process") }}';

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            showResult(resultId, 'success', `
                <div class="alert alert-success">
                    <h5><i class="fas fa-check-circle"></i> ${data.message}</h5>
                    <hr>
                    <p><strong>Nama:</strong> ${data.data.nama}</p>
                    <p><strong>Role:</strong> ${data.data.role}</p>
                    <p><strong>Jam:</strong> ${data.data.jam}</p>
                    <p><strong>Status:</strong> ${data.data.status}</p>
                </div>
            `);
            // Reset input
            document.querySelectorAll('#qr-input, #manual-input, #rfid-input').forEach(el => el.value = '');
        } else if (data.status === 'warning') {
            showResult(resultId, 'warning', `<div class="alert alert-warning">${data.message}</div>`);
        } else {
            showResult(resultId, 'danger', `<div class="alert alert-danger">${data.message}</div>`);
        }
    })
    .catch(error => {
        showResult(resultId, 'danger', `<div class="alert alert-danger">Error: ${error.message}</div>`);
    });
}

// ============================================
// FUNGSI UTILITY
// ============================================

function showResult(elementId, type, message) {
    const element = document.getElementById(elementId);
    if (!element) return;

    const colors = {
        success: 'bg-success text-white',
        warning: 'bg-warning text-dark',
        danger: 'bg-danger text-white',
        info: 'bg-info text-white'
    };

    element.innerHTML = `<div class="p-3 rounded ${colors[type] || 'bg-secondary text-white'}">${message}</div>`;

    // Auto clear setelah 5 detik
    setTimeout(() => {
        element.innerHTML = '';
    }, 10000);
}

// Enter key untuk submit
document.getElementById('qr-input').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') processQR();
});
document.getElementById('manual-input').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') processManual();
});
document.getElementById('rfid-input').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') processRFID();
});
</script>

@endsection