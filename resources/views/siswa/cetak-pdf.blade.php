<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Siswa - {{ $siswa->nama }}</title>
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
        <h1>Data Siswa</h1>
        <p>Sistem Informasi Sekolah</p>
    </div>

    <div class="foto">
        @if($siswa->foto && file_exists(public_path('foto_siswa/' . $siswa->foto)))
            <img src="{{ public_path('foto_siswa/' . $siswa->foto) }}" alt="Foto {{ $siswa->nama }}">
        @else
            <div style="width:300px;height:300px;border-radius:0%;border:2px solid #000;margin:0 auto;display:flex;align-items:center;justify-content:center;background:#f2f2f2;">
                <span style="font-size:50px;color:#999;">?</span>
            </div>
        @endif
    </div>

    <table class="table">
        <tr><th>Nama</th><td>{{ $siswa->nama }}</td></tr>
        <tr><th>NISN</th><td>{{ $siswa->nisn }}</td></tr>
        <tr><th>NIK</th><td>{{ $siswa->nik }}</td></tr>
        <tr><th>Tempat, Tanggal Lahir</th><td>{{ $siswa->tempat_lahir }}, {{ $siswa->tanggal_lahir }}</td></tr>
        <tr><th>Jenis Kelamin</th><td>{{ $siswa->jenis_kelamin }}</td></tr>
        <tr><th>Kelas</th><td>{{ $siswa->kelas }}</td></tr>
        <tr><th>Agama</th><td>{{ $siswa->agama }}</td></tr>
        <tr><th>Nama Ayah</th><td>{{ $siswa->nama_ayah }}</td></tr>
        <tr><th>Pekerjaan Ayah</th><td>{{ $siswa->pekerjaan_ayah }}</td></tr>
        <tr><th>Nama Ibu</th><td>{{ $siswa->nama_ibu }}</td></tr>
        <tr><th>Pekerjaan Ibu</th><td>{{ $siswa->pekerjaan_ibu }}</td></tr>
        <tr><th>Jumlah Saudara</th><td>{{ $siswa->jumlah_saudara }}</td></tr>
        <tr><th>Asal Sekolah</th><td>{{ $siswa->asal_sekolah }}</td></tr>
        <tr><th>Diterima di Sekolah</th><td>{{ $siswa->diterima_di_sekolah }}</td></tr>
        <tr><th>No Ijazah</th><td>{{ $siswa->no_ijazah }}</td></tr>
        <tr><th>Alamat</th><td>{{ $siswa->alamat }}</td></tr>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ date('d-m-Y H:i:s') }}</p>
    </div>
</body>
</html>
