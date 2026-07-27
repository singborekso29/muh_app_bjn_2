@extends('dashboard.layout')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3><i class="fas fa-book text-primary"></i> Master Mata Pelajaran</h3>
        @if(auth()->user()->role == 'admin')
            <a href="{{ route('mata-pelajaran.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Mata Pelajaran
            </a>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form method="GET" action="{{ route('mata-pelajaran.index') }}" class="mb-3">
        <div class="row">
            <div class="col-md-5">
                <input type="text" name="search" class="form-control" placeholder="Cari mata pelajaran..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary">Cari</button>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Mata Pelajaran</th>
                    <th>Kelompok</th>
                    <th>Jam Pelajaran</th>
                    <th>Status</th>
                    @if(auth()->user()->role == 'admin')
                        <th width="150">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($mataPelajaran as $item)
                <tr>
                    <td>{{ $mataPelajaran->firstItem() + $loop->index }}</td>
                    <td>{{ $item->kode_mapel }}</td>
                    <td>{{ $item->nama_mapel }}</td>
                    <td>{{ $item->kelompok ?? '-' }}</td>
                    <td>{{ $item->jam_pelajaran }} JP</td>
                    <td>
                        @if($item->is_active)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-secondary">Tidak Aktif</span>
                        @endif
                    </td>
                    @if(auth()->user()->role == 'admin')
                    <td>
                        <a href="{{ route('mata-pelajaran.edit', $item->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('mata-pelajaran.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus mata pelajaran {{ $item->nama_mapel }}?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada data mata pelajaran.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $mataPelajaran->links() }}
    </div>

</div>

@endsection
