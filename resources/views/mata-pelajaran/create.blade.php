@extends('dashboard.layout')

@section('content')

<div class="container">

<h3>Tambah Mata Pelajaran</h3>

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

<form action="{{ route('mata-pelajaran.store') }}" method="POST">
@csrf

<div class="mb-3">
    <label>Kode Mata Pelajaran</label>
    <input type="text" name="kode_mapel" class="form-control" value="{{ old('kode_mapel') }}" placeholder="Contoh: MTK-01" required>
</div>

<div class="mb-3">
    <label>Nama Mata Pelajaran</label>
    <input type="text" name="nama_mapel" class="form-control" value="{{ old('nama_mapel') }}" required>
</div>

<div class="mb-3">
    <label>Kelompok (opsional)</label>
    <input type="text" name="kelompok" class="form-control" value="{{ old('kelompok') }}" placeholder="Contoh: Wajib A / Muatan Lokal">
</div>

<div class="mb-3">
    <label>Jam Pelajaran per Minggu</label>
    <input type="number" name="jam_pelajaran" class="form-control" min="1" max="20" value="{{ old('jam_pelajaran', 2) }}" required>
</div>

<div class="mb-3">
    <label>Status</label>
    <select name="is_active" class="form-select">
        <option value="1" selected>Aktif</option>
        <option value="0">Tidak Aktif</option>
    </select>
</div>

<button class="btn btn-primary">Simpan</button>
<a href="{{ route('mata-pelajaran.index') }}" class="btn btn-secondary">Kembali</a>

</form>

</div>

@endsection
