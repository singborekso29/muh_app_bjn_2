@extends('dashboard.layout')

@section('content')

<div class="container">

<h3>Edit Tahun Pelajaran</h3>

<hr>

<form
action="{{ route('tahun-pelajaran.update',$tahun_pelajaran->id) }}"
method="POST">

@csrf
@method('PUT')

<div class="mb-3">

<label>Tahun Pelajaran</label>

<input
type="text"
name="tahun"
class="form-control"
value="{{ old('tahun',$tahun_pelajaran->tahun) }}"
required>

</div>

<div class="mb-3">

<label>Semester</label>

<select
name="semester"
class="form-select">

<option value="Ganjil"
{{ $tahun_pelajaran->semester=='Ganjil' ? 'selected' : '' }}>

Ganjil

</option>

<option value="Genap"
{{ $tahun_pelajaran->semester=='Genap' ? 'selected' : '' }}>

Genap

</option>

</select>

</div>

<div class="mb-3">

<label>Tanggal Mulai</label>

<input
type="date"
name="tanggal_mulai"
class="form-control"
value="{{ old('tanggal_mulai',$tahun_pelajaran->tanggal_mulai) }}">

</div>

<div class="mb-3">

<label>Tanggal Selesai</label>

<input
type="date"
name="tanggal_selesai"
class="form-control"
value="{{ old('tanggal_selesai',$tahun_pelajaran->tanggal_selesai) }}">

</div>

<div class="mb-3">

<label>Status</label>

<select
name="is_active"
class="form-select">

<option value="1"
{{ $tahun_pelajaran->is_active ? 'selected' : '' }}>

Aktif

</option>

<option value="0"
{{ !$tahun_pelajaran->is_active ? 'selected' : '' }}>

Tidak Aktif

</option>

</select>

</div>

<button class="btn btn-primary">

Update

</button>

<a href="{{ route('tahun-pelajaran.index') }}"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

@endsection