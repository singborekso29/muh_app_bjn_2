@extends('dashboard.layout')

@section('content')
<div class="container">
    <h1> Tambah Jadwal Pelajaran</h1>
    <hr>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li><i class="fas fa-exclamation-circle"></i> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('jadwal.store') }}" method="POST">
        @csrf

        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
                <!-- Kelas -->
                <div class="mb-3">
                    <label> Kelas <span class="text-danger">*</span></label>
                    <select name="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kelas }} ({{ $k->tingkat }})
                            </option>
                        @endforeach
                    </select>
                    @error('kelas_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Mata Pelajaran -->
                <div class="mb-3">
                    <label><i class="fas fa-book"></i> Mata Pelajaran <span class="text-danger">*</span></label>
                    <select name="mata_pelajaran_id" class="form-control @error('mata_pelajaran_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Mata Pelajaran --</option>
                        @foreach($mataPelajaran as $mp)
                            <option value="{{ $mp->id }}" {{ old('mata_pelajaran_id') == $mp->id ? 'selected' : '' }}>
                                {{ $mp->kode_mapel }} - {{ $mp->nama_mapel }} <!-- ← PAKAI nama_mapel -->
                            </option>
                        @endforeach
                    </select>
                    @error('mata_pelajaran_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Guru -->
                <div class="mb-3">
                    <label><i class="fas fa-chalkboard-teacher"></i> Guru</label>
                    <select name="guru_id" class="form-control @error('guru_id') is-invalid @enderror">
                        <option value="">-- Pilih Guru --</option>
                        @foreach($guru as $g)
                            <option value="{{ $g->id }}" {{ old('guru_id') == $g->id ? 'selected' : '' }}>
                                {{ $g->nama }} ({{ $g->mapel }})
                            </option>
                        @endforeach
                    </select>
                    @error('guru_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-md-6">
                <!-- Hari -->
                <div class="mb-3">
                    <label><i class="fas fa-calendar-day"></i> Hari <span class="text-danger">*</span></label>
                    <select name="hari" class="form-control @error('hari') is-invalid @enderror" required>
                        <option value="">-- Pilih Hari --</option>
                        <option value="Senin" {{ old('hari') == 'Senin' ? 'selected' : '' }}>Senin</option>
                        <option value="Selasa" {{ old('hari') == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                        <option value="Rabu" {{ old('hari') == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                        <option value="Kamis" {{ old('hari') == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                        <option value="Jumat" {{ old('hari') == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                        <option value="Sabtu" {{ old('hari') == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                    </select>
                    @error('hari')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Jam Mulai -->
                <div class="mb-3">
                    <label><i class="fas fa-clock"></i> Jam Mulai <span class="text-danger">*</span></label>
                    <input type="time" name="jam_mulai" class="form-control @error('jam_mulai') is-invalid @enderror" 
                           value="{{ old('jam_mulai') }}" required>
                    @error('jam_mulai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Jam Selesai -->
                <div class="mb-3">
                    <label><i class="fas fa-clock"></i> Jam Selesai <span class="text-danger">*</span></label>
                    <input type="time" name="jam_selesai" class="form-control @error('jam_selesai') is-invalid @enderror" 
                           value="{{ old('jam_selesai') }}" required>
                    @error('jam_selesai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Ruangan -->
                <div class="mb-3">
                    <label><i class="fas fa-door-open"></i> Ruangan</label>
                    <input type="text" name="ruangan" class="form-control @error('ruangan') is-invalid @enderror" 
                           value="{{ old('ruangan') }}" placeholder="Contoh: Ruang 101">
                    @error('ruangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Tahun Pelajaran - Full Width -->
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label><i class="fas fa-calendar-alt"></i> Tahun Pelajaran <span class="text-danger">*</span></label>
                    <select name="tahun_pelajaran_id" class="form-control @error('tahun_pelajaran_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Tahun Pelajaran --</option>
                        @foreach($tahunPelajaran as $tp)
                            <option value="{{ $tp->id }}" {{ old('tahun_pelajaran_id') == $tp->id ? 'selected' : '' }}>
                                {{ $tp->tahun }} - {{ $tp->semester }}
                                @if($tp->is_active) <span class="badge bg-success">Aktif</span> @endif
                            </option>
                        @endforeach
                    </select>
                    @error('tahun_pelajaran_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <!-- Keterangan -->
                <div class="mb-3">
                    <label><i class="fas fa-info-circle"></i> Keterangan</label>
                    <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" 
                              rows="3">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Tombol -->
        <div class="row mt-3">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="{{ route('jadwal.index') }}" class="btn btn-secondary btn-lg">
                    <i class="fas fa-arrow-left"></i> Batal
                </a>
            </div>
        </div>

    </form>
</div>
@endsection