@extends('dashboard.layout')

@section('content')

<div class="container">

<h3>Edit Kelas</h3>

<hr>

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('kelas.update', $kelas->id) }}" method="POST">
@csrf
@method('PUT')

<div class="mb-3">
    <label>Nama Kelas</label>
    <input type="text" name="nama_kelas" class="form-control" value="{{ old('nama_kelas', $kelas->nama_kelas) }}" required>
</div>

<div class="mb-3">
    <label>Tingkat</label>
    <select name="tingkat" class="form-select" required>
        <option value="VII" {{ old('tingkat', $kelas->tingkat) == 'VII' ? 'selected' : '' }}>VII</option>
        <option value="VIII" {{ old('tingkat', $kelas->tingkat) == 'VIII' ? 'selected' : '' }}>VIII</option>
        <option value="IX" {{ old('tingkat', $kelas->tingkat) == 'IX' ? 'selected' : '' }}>IX</option>
    </select>
</div>

<div class="mb-3">
    <label>Jurusan (opsional)</label>
    <input type="text" name="jurusan" class="form-control" value="{{ old('jurusan', $kelas->jurusan) }}">
</div>

<div class="mb-3">
    <label>Wali Kelas</label>
    <select name="guru_id" class="form-control @error('guru_id') is-invalid @enderror">
        <option value="">-- Pilih Wali Kelas --</option>
        @foreach($gurus as $guru)
            <option value="{{ $guru->id }}"
                {{ old('guru_id', $kelas->guru_id) == $guru->id ? 'selected' : '' }}>
                {{ $guru->nama }} ({{ $guru->mapel }})
            </option>
        @endforeach
    </select>
    @error('guru_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label>Tahun Pelajaran</label>
    <select name="tahun_pelajaran_id" class="form-select @error('tahun_pelajaran_id') is-invalid @enderror" required>
        <option value="">-- Pilih Tahun Pelajaran --</option>
        @foreach($tahunPelajarans as $tp)
            <option value="{{ $tp->id }}"
                {{ old('tahun_pelajaran_id', $kelas->tahun_pelajaran_id) == $tp->id ? 'selected' : '' }}>
                {{ $tp->tahun }} - {{ $tp->semester }}
            </option>
        @endforeach
    </select>
    @error('tahun_pelajaran_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label>Kapasitas</label>
    <input type="number" name="kapasitas" class="form-control" min="1" max="100" value="{{ old('kapasitas', $kelas->kapasitas) }}">
</div>

<div class="mb-3">
    <label>Keterangan (opsional)</label>
    <textarea name="keterangan" class="form-control">{{ old('keterangan', $kelas->keterangan) }}</textarea>
</div>

<button class="btn btn-primary">Update</button>

<a href="{{ route('kelas.index') }}" class="btn btn-secondary">Kembali</a>

</form>

</div>

@endsection
