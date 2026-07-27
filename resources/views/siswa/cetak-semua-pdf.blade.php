<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Semua Data Siswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 5px; font-size: 10px; }
        th { background-color: #f2f2f2; }
        .text-center { text-align: center; }
        .footer { text-align: center; margin-top: 20px; font-size: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Form 8355 </h2>
        <p>Dicetak: {{ date('d-m-Y H:i:s') }}</p>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>NISN</th>
                <th>NIK</th>
                <th>Jenis Kelamin</th>
                <th>Agama</th>
                <th>Alamat</th>
                <th>No Ijazah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($siswa as $key => $item)
            <tr>
                <td class="text-center">{{ $key + 1 }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->tempat_lahir }}</td>
                <td>{{ $item->tanggal_lahir }}</td>
                <td>{{ $item->nisn }}</td>
                <td>{{ $item->nik }}</td>
                <td>{{ $item->jenis_kelamin }}</td>
                <td>{{ $item->agama }}</td>
                <td>{{ $item->alamat }}</td>
                <td>{{ $item->no_ijazah }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="footer">
        <p>Total Siswa/i: {{ $siswa->count() }} Orang</p>
    </div>
</body>
</html>