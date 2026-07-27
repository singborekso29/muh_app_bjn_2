@extends('dashboard.layout')
@include('dashboard.components.alert')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Data Guru</h1>
        <div>
            @if(auth()->user()->role == 'admin')
                <a href="{{ route('guru.create') }}" class="btn btn-primary me-2">
                    <i class="fas fa-plus"></i> Tambah Guru
                </a>
            @endif

            <a href="{{ route('guru.cetak-semua') }}" class="btn btn-danger" target="_blank">
                <i class="fas fa-file-pdf"></i> Cetak Semua PDF
            </a>
        </div>
    </div>
    
    
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Mapel</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($guru as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($item->foto && file_exists(public_path('foto_guru/' . $item->foto)))
                            <img src="{{ asset('foto_guru/' . $item->foto) }}" 
                                 width="50" height="50" 
                                 style="object-fit: cover; border-radius: 50%;">
                        @else
                            <i class="fas fa-user-circle" style="font-size: 40px; color: #ccc;"></i>
                        @endif
                    </td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->nip }}</td>
                    <td>{{ $item->mapel }}</td>
                    <td>
                        <a href="{{ route('guru.show', $item->id) }}" class="btn btn-info btn-sm text-white">Detail</a>
                        @include('dashboard.components.button',[
                            'href'=>route('guru.cetak-pdf',$item->id),
                            'type'=>'danger',
                            'icon'=>'fas fa-file-pdf',
                            'text'=>'PDF',
                            'target'=>'_blank'
                        ])
                        
                        @if($item->berkas && file_exists(public_path('berkas_guru/' . $item->berkas)))
                            @include('dashboard.components.button',[
                                'href'=>route('guru.download-berkas', $item->id),
                                'type'=>'success',
                                'icon'=>'fas fa-download',
                                'text'=>'Berkas'
                            ])
                        @endif

                        @if(auth()->user()->role == 'admin')
                            @include('dashboard.components.button',[
                                'href'=>route('guru.edit', $item->id),
                                'type'=>'warning',
                                'icon'=>'fas fa-edit',
                                'text'=>'Edit'
                            ])

                            <form action="{{ route('guru.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data guru ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data guru</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-3">
        <p class="text-muted">
            <i class="fas fa-info-circle"></i> Total Guru: {{ $guru->count() }} Orang
        </p>
    </div>
</div>
@endsection