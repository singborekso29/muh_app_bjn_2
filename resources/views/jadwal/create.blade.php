@extends('dashboard.layout')

@section('content')

<div class="container">

<h3>Tambah Mata Pelajaran</h3>

<hr>

<form
action="{{ route('mata-pelajaran.store') }}"
method="POST">

@csrf

<div class="mb-3">

<label>Kode Mata Pelajaran</label>

<input
type="text"
name="kode"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Nama Mata Pelajaran</label>

<input
type="text"
name="nama"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Kelompok</label>

<select
name="kelompok"
class="form-select">

<option value="Umum">Umum</option>

<option value="Muatan Lokal">Muatan Lokal</option>

<option value="Keislaman">Keislaman</option>

</select>

</div>

<button class="btn btn-primary">

Simpan

</button>

<a
href="{{ route('mata-pelajaran.index') }}"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

@endsection
