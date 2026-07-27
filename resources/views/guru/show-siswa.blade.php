@extends('dashboard.layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Detail Guru</h3>
                    <a href="{{ route('guru.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Foto -->
                        <div class="col-md-4 text-center">
                            @if($guru->foto && file_exists(public_path('foto_guru/' . $guru->foto)))
                                <img src="{{ asset('foto_guru/' . $guru->foto) }}"
                                     class="img-fluid rounded"
                                     style="max-width: 200px; max-height: 200px; object-fit: cover;">
                            @else
                                <i class="fas fa-user-circle" style="font-size: 150px; color: #ccc;"></i>
                            @endif
                        </div>

                        <!-- Data Guru (read-only, tanpa data sensitif kepegawaian) -->
                        <div class="col-md-8">
                            <h4 class="text-center mb-3">DATA GURU</h4>
                            <h4 class="text-center mb-3">SMP MUHAMMADIYAH BOJONG NANGKA</h4>
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <th width="35%">Nama</th>
                                    <td>{{ $guru->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Mata Pelajaran</th>
                                    <td>{{ $guru->mapel }}</td>
                                </tr>
                                <tr>
                                    <th>Pendidikan Terakhir</th>
                                    <td>{{ $guru->pendidikan_terakhir }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
