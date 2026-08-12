@extends('dashboard.layout')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3><i class="fas fa-list-check text-primary"></i> Rekap Siswa per Kelas</h3>
        <a href="{{ route('pembagian-kelas.index') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-arrow-right"></i> Ke Halaman Pembagian Kelas
        </a>
    </div>

    <form method="GET" action="{{ route('pembagian-kelas.rekap') }}" class="mb-4">
        <div class="row">
            <div class="col-md-6">
                <label>Tahun Pelajaran</label>
                <select name="tahun_pelajaran_id" class="form-select" onchange="this.form.submit()">
                    @forelse($tahunPelajarans as $tp)
                        <option value="{{ $tp->id }}" {{ $tahunPelajaranId == $tp->id ? 'selected' : '' }}>
                            {{ $tp->tahun }} - {{ $tp->semester }}
                        </option>
                    @empty
                        <option value="">Belum ada tahun pelajaran</option>
                    @endforelse
                </select>
            </div>
        </div>
    </form>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Sudah Dibagi Kelas</h5>
                    <h2 class="mb-0">{{ $totalSudahDibagi }} siswa</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Belum Dibagi Kelas</h5>
                    <h2 class="mb-0">{{ $totalBelumDibagi }} siswa</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Kelas</h5>
                    <h2 class="mb-0">{{ $daftarKelas->count() }} kelas</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion" id="accordionKelas">
        @forelse($daftarKelas as $kelas)
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button"
                            data-bs-toggle="collapse" data-bs-target="#kelas-{{ $kelas->id }}">
                        <strong>{{ $kelas->nama_kelas }}</strong>&nbsp;({{ $kelas->tingkat }})
                        <span class="badge bg-secondary ms-2">{{ $kelas->siswa->count() }} siswa</span>
                    </button>
                </h2>
                <div id="kelas-{{ $kelas->id }}"
                     class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                     data-bs-parent="#accordionKelas">
                    <div class="accordion-body">
                        @if($kelas->siswa->isEmpty())
                            <p class="text-muted mb-0">Belum ada siswa di kelas ini.</p>
                        @else
                            <table class="table table-sm table-bordered mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Nama</th>
                                        <th>NISN</th>
                                        <th>Jenis Kelamin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kelas->siswa as $i => $siswa)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $siswa->nama }}</td>
                                            <td>{{ $siswa->nisn }}</td>
                                            <td>{{ $siswa->jenis_kelamin ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info">Belum ada data kelas.</div>
        @endforelse
    </div>

</div>

@endsection