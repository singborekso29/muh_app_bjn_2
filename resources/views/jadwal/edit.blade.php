@extends('dashboard.layout')

@section('content')

<div class="container">

<h3>Edit Mata Pelajaran</h3>

<hr>

<form
action="{{ route('mata-pelajaran.update',$mata_pelajaran->id) }}"
method="POST">

@csrf
@method('PUT')

<div class="mb-3">

<label>Kode Mata Pelajaran</label>

<input
type="text"
name="kode"
value="{{ $mata_pelajaran->kode }}"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Nama Mata Pelajaran</label>

<input
type="text"
name="nama"
value="{{ $mata_pelajaran->nama }}"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Kelompok</label>

<select
name="kelompok"
class="form-select">

<option
value="Umum"
{{ $mata_pelajaran->kelompok=='Umum' ? 'selected':'' }}>

Umum

</option>

<option
value="Muatan Lokal"
{{ $mata_pelajaran->kelompok=='Muatan Lokal' ? 'selected':'' }}>

Muatan Lokal

</option>

<option
value="Keislaman"
{{ $mata_pelajaran->kelompok=='Keislaman' ? 'selected':'' }}>

Keislaman

</option>

</select>

</div>

<button class="btn btn-primary">

Update

</button>

<a
href="{{ route('mata-pelajaran.index') }}"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

@endsection
