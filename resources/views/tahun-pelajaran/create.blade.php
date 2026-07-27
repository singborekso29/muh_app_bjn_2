@extends('dashboard.layout')

@section('content')

<div class="container">

<h3>Tambah Tahun Pelajaran</h3>

<hr>

<form action="{{ route('tahun-pelajaran.store') }}" method="POST">

@csrf

<div class="mb-3">

<label>Tahun Pelajaran</label>

<input
type="text"
name="tahun"
class="form-control"
placeholder="2026/2027"
required>

</div>

<div class="mb-3">

<label>Semester</label>

<select
name="semester"
class="form-select">

<option value="Ganjil">Ganjil</option>

<option value="Genap">Genap</option>

</select>

</div>

<div class="mb-3">

<label>Tanggal Mulai</label>

<input
type="date"
name="tanggal_mulai"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Tanggal Selesai</label>

<input
type="date"
name="tanggal_selesai"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Status</label>

<select
name="is_active"
class="form-select">

<option value="1">

Aktif

</option>

<option value="0">

Tidak Aktif

</option>

</select>

</div>

<button class="btn btn-primary">

Simpan

</button>

<a href="{{ route('tahun-pelajaran.index') }}"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

@endsection