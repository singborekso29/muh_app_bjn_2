<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Semua Data Guru</title>
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
        <h2>Laporan Data Guru</h2>
        <p>Dicetak: {{ date('d-m-Y H:i:s') }}</p>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Mata Pelajaran</th>
                <th>Status</th>
                <th>Pendidikan</th>
                <th>No Telepon</th>
            </tr>
        </thead>
        <tbody>
            @foreach($guru as $key => $item)
            <tr>
                <td class="text-center">{{ $key + 1 }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->nip }}</td>
                <td>{{ $item->mapel }}</td>
                <td>{{ $item->status_kepegawaian }}</td>
                <td>{{ $item->pendidikan_terakhir }}</td>
                <td>{{ $item->no_telepon }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="footer">
        <p>Total Guru: {{ $guru->count() }} Orang</p>
    </div>
</body>
</html>