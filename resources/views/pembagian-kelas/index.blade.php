@extends('dashboard.layout')

@section('content')

<div class="container">

    <h3>
        <i class="fas fa-users text-primary"></i>
        Pembagian Kelas
    </h3>

    <p class="text-muted">
        Pilih tahun pelajaran dan kelas, lalu tambahkan siswa yang belum memiliki kelas.
    </p>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close">
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- ========================================================= --}}
    {{-- PILIH TAHUN PELAJARAN --}}
    {{-- ========================================================= --}}

    <form method="GET"
          action="{{ route('pembagian-kelas.index') }}"
          class="mb-3">

        <div class="row">

            <div class="col-md-6">

                <label class="form-label fw-bold">
                    Tahun Pelajaran
                </label>

                <select name="tahun_pelajaran_id"
                        class="form-select"
                        onchange="this.form.submit()">

                    <option value="">
                        -- Pilih Tahun Pelajaran --
                    </option>

                    @foreach($tahunPelajarans as $tp)

                        <option value="{{ $tp->id }}"
                            {{ $tahunPelajaranId == $tp->id ? 'selected' : '' }}>

                            {{ $tp->nama ?? $tp->tahun_pelajaran ?? $tp->tahun }}

                            @if($tp->is_active)
                                (Aktif)
                            @endif

                        </option>

                    @endforeach

                </select>

            </div>

        </div>

    </form>


    {{-- ========================================================= --}}
    {{-- PILIH KELAS --}}
    {{-- ========================================================= --}}

    @if($tahunPelajaranId)

        <form method="GET"
              action="{{ route('pembagian-kelas.index') }}"
              class="mb-4">

            <input type="hidden"
                   name="tahun_pelajaran_id"
                   value="{{ $tahunPelajaranId }}">

            <div class="row">

                <div class="col-md-6">

                    <label class="form-label fw-bold">
                        Kelas
                    </label>

                    <select name="kelas_id"
                            class="form-select"
                            onchange="this.form.submit()">

                        <option value="">
                            -- Pilih Kelas --
                        </option>

                        @foreach($daftarKelas as $k)

                            <option value="{{ $k->id }}"
                                {{ request('kelas_id') == $k->id ? 'selected' : '' }}>

                                {{ $k->nama_kelas }}

                                @if($k->jurusan)
                                    ({{ $k->jurusan }})
                                @endif

                            </option>

                        @endforeach

                    </select>

                </div>

            </div>

        </form>

    @else

        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle"></i>
            Tahun pelajaran belum dipilih.
        </div>

    @endif


    {{-- ========================================================= --}}
    {{-- DATA PEMBAGIAN KELAS --}}
    {{-- ========================================================= --}}

    @if($kelasTerpilih)

        <div class="row">

            {{-- ================================================= --}}
            {{-- SISWA DI KELAS --}}
            {{-- ================================================= --}}

            <div class="col-md-6">

                <div class="card">

                    <div class="card-header bg-success text-white">

                        <i class="fas fa-user-check"></i>

                        Siswa di Kelas
                        {{ $kelasTerpilih->nama_kelas }}

                        <span class="badge bg-light text-dark">
                            {{ $siswaDiKelasIni->count() }} siswa
                        </span>

                    </div>


                    <div class="card-body"
                         style="max-height: 500px; overflow-y: auto;">

                        @forelse($siswaDiKelasIni as $siswa)

                            <div class="d-flex justify-content-between align-items-center border-bottom py-2">

                                <div>

                                    <strong>
                                        {{ $siswa->nama }}
                                    </strong>

                                    <br>

                                    <small class="text-muted">
                                        NISN: {{ $siswa->nisn }}
                                    </small>

                                </div>


                                {{-- FORM KELUARKAN --}}

                                <form
                                    action="{{ route('pembagian-kelas.keluarkan', $siswa->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Keluarkan {{ $siswa->nama }} dari kelas ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <input type="hidden"
                                           name="tahun_pelajaran_id"
                                           value="{{ $tahunPelajaranId }}">

                                    <input type="hidden"
                                           name="kelas_id"
                                           value="{{ $kelasTerpilih->id }}">

                                    <button type="submit"
                                            class="btn btn-outline-danger btn-sm">

                                        <i class="fas fa-times"></i>
                                        Keluarkan

                                    </button>

                                </form>

                            </div>

                        @empty

                            <p class="text-muted mb-0">
                                Belum ada siswa di kelas ini.
                            </p>

                        @endforelse

                    </div>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- SISWA BELUM PUNYA KELAS --}}
            {{-- ================================================= --}}

            <div class="col-md-6">

                <form action="{{ route('pembagian-kelas.tambah') }}"
                      method="POST">

                    @csrf

                    {{-- WAJIB DIKIRIM --}}

                    <input type="hidden"
                           name="tahun_pelajaran_id"
                           value="{{ $tahunPelajaranId }}">

                    <input type="hidden"
                           name="kelas_id"
                           value="{{ $kelasTerpilih->id }}">


                    <div class="card">

                        <div class="card-header bg-warning">

                            <i class="fas fa-user-plus"></i>

                            Siswa Belum Punya Kelas

                            <span class="badge bg-light text-dark">
                                {{ $siswaBelumPunyaKelas->count() }} siswa
                            </span>

                        </div>


                        <div class="card-body"
                             style="max-height: 500px; overflow-y: auto;">

                            @forelse($siswaBelumPunyaKelas as $siswa)

                                <div class="form-check border-bottom py-2">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="siswa_ids[]"
                                        value="{{ $siswa->id }}"
                                        id="siswa-{{ $siswa->id }}">

                                    <label
                                        class="form-check-label"
                                        for="siswa-{{ $siswa->id }}">

                                        <strong>
                                            {{ $siswa->nama }}
                                        </strong>

                                        <br>

                                        <small class="text-muted">
                                            NISN: {{ $siswa->nisn }}
                                        </small>

                                    </label>

                                </div>

                            @empty

                                <p class="text-muted mb-0">
                                    Semua siswa sudah punya kelas. 🎉
                                </p>

                            @endforelse

                        </div>


                        @if($siswaBelumPunyaKelas->count() > 0)

                            <div class="card-footer">

                                <button type="submit"
                                        class="btn btn-primary w-100">

                                    <i class="fas fa-arrow-right"></i>

                                    Masukkan yang Dicentang
                                    ke Kelas Ini

                                </button>

                            </div>

                        @endif

                    </div>

                </form>

            </div>

        </div>

    @elseif($tahunPelajaranId)

        <div class="alert alert-info">

            <i class="fas fa-info-circle"></i>

            Silakan pilih kelas terlebih dahulu.

        </div>

    @endif

</div>

@endsection