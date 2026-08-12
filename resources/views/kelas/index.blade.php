@extends('dashboard.layout')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1><i class="fas fa-school text-primary"></i> Data Kelas</h1>
        <a href="{{ route('kelas.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Kelas
        </a>
    </div>
    
    <!-- Form Search -->
    <div class="row mb-3">
        <div class="col-md-6">
            <form action="{{ route('kelas.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" 
                       placeholder="Cari kelas, tingkat, jurusan, wali kelas..." 
                       value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('kelas.index') }}" class="btn btn-secondary ms-2">
                        <i class="fas fa-times"></i> Reset
                    </a>
                @endif
            </form>
        </div>
        <div class="col-md-6 text-end">
            <span class="text-muted">Total: {{ $kelas->total() }} Kelas</span>
        </div>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Kelas</th>
                    <th>Kelas</th>
                                     <th>Kapasitas</th>
                    <th>Wali Kelas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kelas as $item)
                <tr>
                    <td>{{ $loop->iteration + ($kelas->currentPage() - 1) * $kelas->perPage() }}</td>
                    <td><strong>{{ $item->nama_kelas }}</strong></td>
                    <td>{{ $item->jurusan }}</td>
                    
                    <td>{{ $item->kapasitas }}</td>
                   
                    <td>
                        @if($item->guru)
                            {{ $item->guru->nama }}
                        @else
                            -
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('kelas.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('kelas.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus kelas {{ $item->nama_kelas }}?')" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">
                        <i class="fas fa-inbox fa-2x text-muted d-block mb-2"></i>
                        @if(request('search'))
                            Data kelas dengan kata kunci "<strong>{{ request('search') }}</strong>" tidak ditemukan
                        @else
                            Belum ada data kelas
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    <!-- Pagination -->
    <div class="mt-3">
        {{ $kelas->links() }}
    </div>
</div>
@endsection