@extends('dashboard.layout')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1></i> Jadwal Pelajaran</h1>
        <a href="{{ route('jadwal.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Jadwal
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Kelas</th>
                    <th>Mata Pelajaran</th>
                    <th>Guru</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Ruangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jadwal as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->kelas ? $item->kelas->nama_kelas : '-' }}</td>
                    <td>{{ $item->mataPelajaran ? $item->mataPelajaran->nama : '-' }}</td>
                    <td>{{ $item->guru ? $item->guru->nama : '-' }}</td>
                    <td>{{ $item->hari }}</td>
                    <td>{{ $item->jam_mulai }} - {{ $item->jam_selesai }}</td>
                    <td>{{ $item->ruangan ?? '-' }}</td>
                    <td>
                        <a href="{{ route('jadwal.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('jadwal.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('jadwal.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">Belum ada data jadwal</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection