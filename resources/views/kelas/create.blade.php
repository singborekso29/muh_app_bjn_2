@extends('dashboard.layout')

@section('content')

<div class="container">

<h3>Tambah Kelas</h3>

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

<form action="{{ route('kelas.store') }}" method="POST">
@csrf

<div class="mb-3">
    <label>Nama Kelas</label>
    <input type="text" name="nama_kelas" class="form-control" value="{{ old('nama_kelas') }}" placeholder="Contoh: VII A" required>
</div>

<div class="mb-3">
    <label>Tingkat</label>
    <select name="tingkat" class="form-select" required>
        <option value="">-- Pilih Tingkat --</option>
        <option value="VII" {{ old('tingkat') == 'VII' ? 'selected' : '' }}>VII</option>
        <option value="VIII" {{ old('tingkat') == 'VIII' ? 'selected' : '' }}>VIII</option>
        <option value="IX" {{ old('tingkat') == 'IX' ? 'selected' : '' }}>IX</option>
    </select>
</div>

<div class="mb-3">
    <label>Jurusan (opsional)</label>
    <input type="text" name="jurusan" class="form-control" value="{{ old('jurusan') }}">
</div>

<div class="mb-3">
    <label>Wali Kelas</label>
    <select name="guru_id" class="form-select">
        <option value="">-- Pilih Wali Kelas --</option>
        @foreach($gurus as $g)
            <option value="{{ $g->id }}" {{ old('guru_id') == $g->id ? 'selected' : '' }}>
                {{ $g->nama }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Tahun Pelajaran</label>
    <select name="tahun_pelajaran_id" class="form-select" required>
        <option value="">-- Pilih Tahun Pelajaran --</option>
        @foreach($tahunPelajarans as $tp)
            <option value="{{ $tp->id }}" {{ old('tahun_pelajaran_id') == $tp->id ? 'selected' : '' }}>
                {{ $tp->tahun }} - {{ $tp->semester }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Kapasitas</label>
    <input type="number" name="kapasitas" class="form-control" min="1" max="100" value="{{ old('kapasitas', 30) }}">
</div>

<div class="mb-3">
    <label>Keterangan (opsional)</label>
    <textarea name="keterangan" class="form-control">{{ old('keterangan') }}</textarea>
</div>

<button class="btn btn-primary">Simpan</button>

<a href="{{ route('kelas.index') }}" class="btn btn-secondary">Kembali</a>

</form>

</div>

@endsection
