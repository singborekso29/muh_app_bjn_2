@extends('dashboard.layout')

@section('content')

<div class="container">

<h3>Edit Mata Pelajaran</h3>

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

<form action="{{ route('mata-pelajaran.update', $mataPelajaran->id) }}" method="POST">
@csrf
@method('PUT')

<div class="mb-3">
    <label>Kode Mata Pelajaran</label>
    <input type="text" name="kode_mapel" class="form-control" value="{{ old('kode_mapel', $mataPelajaran->kode_mapel) }}" required>
</div>

<div class="mb-3">
    <label>Nama Mata Pelajaran</label>
    <input type="text" name="nama_mapel" class="form-control" value="{{ old('nama_mapel', $mataPelajaran->nama_mapel) }}" required>
</div>

<div class="mb-3">
    <label>Kelompok (opsional)</label>
    <input type="text" name="kelompok" class="form-control" value="{{ old('kelompok', $mataPelajaran->kelompok) }}">
</div>

<div class="mb-3">
    <label>Jam Pelajaran per Minggu</label>
    <input type="number" name="jam_pelajaran" class="form-control" min="1" max="20" value="{{ old('jam_pelajaran', $mataPelajaran->jam_pelajaran) }}" required>
</div>

<div class="mb-3">
    <label>Status</label>
    <select name="is_active" class="form-select">
        <option value="1" {{ old('is_active', $mataPelajaran->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
        <option value="0" {{ old('is_active', $mataPelajaran->is_active) == 0 ? 'selected' : '' }}>Tidak Aktif</option>
    </select>
</div>

<button class="btn btn-primary">Update</button>
<a href="{{ route('mata-pelajaran.index') }}" class="btn btn-secondary">Kembali</a>

</form>

</div>

@endsection
