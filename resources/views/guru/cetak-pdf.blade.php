<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Guru - {{ $guru->nama }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { text-align: center; border-bottom: 3px double #000; padding-bottom: 10px; }
        .header h1 { margin: 0; font-size: 24px; text-transform: uppercase; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th { background-color: #f2f2f2; border: 1px solid #000; padding: 8px; text-align: left; width: 30%; }
        .table td { border: 1px solid #000; padding: 8px; }
        .foto { text-align: center; margin-bottom: 20px; }
        .foto img { width: 300px; height: 300px; object-fit: cover; border-radius: 50%; border: 2px solid #000; }
        .footer { text-align: center; margin-top: 30px; border-top: 1px solid #000; padding-top: 10px; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Data Guru</h1>
        <p>Sistem Informasi Sekolah</p>
    </div>
    
    <div class="foto">
        @if($guru->foto && file_exists(public_path('foto_guru/' . $guru->foto)))
            <img src="{{ public_path('foto_guru/' . $guru->foto) }}" alt="Foto {{ $guru->nama }}">
        @else
            <div style="width:300px;height:300px;border-radius:0%;border:2px solid #000;margin:0 auto;display:flex;align-items:center;justify-content:center;background:#f2f2f2;">
                <span style="font-size:50px;color:#999;">?</span>
            </div>
        @endif
    </div>
    
    <table class="table">
        <tr><th>Nama</th><td>{{ $guru->nama }}</td></tr>
        <tr><th>NIP</th><td>{{ $guru->nip }}</td></tr>
        <tr><th>Tempat Lahir</th><td>{{ $guru->tempat_lahir }}</td></tr>
        <tr><th>Tanggal Lahir</th><td>{{ $guru->tanggal_lahir }}</td></tr>
        <tr><th>Jenis Kelamin</th><td>{{ $guru->jenis_kelamin }}</td></tr>
        <tr><th>Agama</th><td>{{ $guru->agama }}</td></tr>
        <tr><th>Pendidikan Terakhir</th><td>{{ $guru->pendidikan_terakhir }}</td></tr>
        <tr><th>Jurusan</th><td>{{ $guru->jurusan }}</td></tr>
        <tr><th>Status Kepegawaian</th><td>{{ $guru->status_kepegawaian }}</td></tr>
        <tr><th>Mata Pelajaran</th><td>{{ $guru->mapel }}</td></tr>
        <tr><th>No Telepon</th><td>{{ $guru->no_telepon }}</td></tr>
        <tr><th>Alamat</th><td>{{ $guru->alamat }}</td></tr>
    </table>
    
    <div class="footer">
        <p>Dicetak pada: {{ date('d-m-Y H:i:s') }}</p>
    </div>
</body>
</html>