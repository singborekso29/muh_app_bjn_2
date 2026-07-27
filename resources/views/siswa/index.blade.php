@extends('dashboard.layout')
@include('dashboard.components.alert')


@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Data Siswa</h1>
        <div>
            @if(auth()->user()->role == 'admin')
                <a href="{{ route('siswa.create') }}" class="btn btn-primary me-2">
                    <i class="fas fa-plus"></i> Tambah Siswa
                </a>
            @endif

            <a href="{{ route('siswa.cetak-semua') }}" class="btn btn-danger" target="_blank">
                <i class="fas fa-file-pdf"></i> Cetak Semua PDF
            </a>
        </div>
    </div>
    
   <form method="GET" action="{{ route('siswa.index') }}" class="mb-3">

    <div class="row">

        <div class="col-md-6">

            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Cari Nama / NISN / NIK..."
                value="{{ request('search') }}">

        </div>

        <div class="col-md-2">

            <button class="btn btn-primary">

                Cari

            </button>

        </div>

        <div class="col-md-2">

            <a href="{{ route('siswa.index') }}"
               class="btn btn-secondary">

               Reset

            </a>

        </div>

    </div>

</form>
        
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>NIS/NISN</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($siswa as $item)
                <tr>
                    <td>{{ $siswa->firstItem() + $loop->index }}</td>
                    <td>
                        @if($item->foto && file_exists(public_path('foto_siswa/' . $item->foto)))
                            <img src="{{ asset('foto_siswa/' . $item->foto) }}" 
                                 width="50" height="50" 
                                 style="object-fit: cover; border-radius: 50%;">
                        @else
                            <i class="fas fa-user-circle" style="font-size: 40px; color: #ccc;"></i>
                        @endif
                    </td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->nis ?? $item->nisn ?? '-' }}</td>
                    <td>{{ $item->kelas ?? '-' }}</td>
                    <td>
                        <a href="{{ route('siswa.show-siswa', $item->id) }}" class="btn btn-info btn-sm text-white">Detail</a>
                        <a href="{{ route('siswa.show-siswa', $item->id) }}" class="btn btn-danger btn-sm" target="_blank">PDF</a>

                        @if(auth()->user()->role == 'admin')
                            <a href="{{ route('siswa.edit', $item->id) }}" class="btn btn-warning btn-sm text-white">Edit</a>
                            
                            <form action="{{ route('siswa.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data siswa ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data siswa</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- ============================================ -->
    <!-- PAGINATION - UNTUK HALAMAN 2, 3, 4, ...     -->
    <!-- ============================================ -->
    <div class="d-flex justify-content-between align-items-center mt-6">
        <style>
    .pagination {
        display: flex;
        justify-content: center;
        gap: 5px;
    }
    .pagination .page-item .page-link {
        padding: 8px 14px;
        border-radius: 5px;
        color: #333;
        border: 1px solid #ddd;
    }
    .pagination .page-item.active .page-link {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }
    .pagination .page-item.disabled .page-link {
        color: #ccc;
        pointer-events: none;
    }
    .pagination .page-item .page-link:hover {
        background-color: #e9ecef;
    }
</style>
        <div>
            <p class="text-muted mb-0">
                Menampilkan {{ $siswa->firstItem() }} - {{ $siswa->lastItem() }} 
                dari {{ $siswa->total() }} data
            </p>
        </div>
        <!-- <div>
            {{ $siswa->links() }}
        </div> -->
    </div>
    </div>
    
</div>


@endsection