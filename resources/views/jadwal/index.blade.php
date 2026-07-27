@extends('dashboard.layout')

@section('content')

<div class="container">

<div class="d-flex justify-content-between mb-3">

<h3>Data Mata Pelajaran</h3>

<a href="{{ route('mata-pelajaran.create') }}"
class="btn btn-primary">

Tambah Mata Pelajaran

</a>

</div>

@if(session('success'))

<div class="alert alert-success">

{{ session('success') }}

</div>

@endif

<div class="card">

<div class="card-body">

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>

<th width="60">No</th>

<th>Kode</th>

<th>Nama Mata Pelajaran</th>

<th>Kelompok</th>

<th width="170">Aksi</th>

</tr>

</thead>

<tbody>

@forelse($mataPelajaran as $item)

<tr>

<td>

{{ $loop->iteration + ($mataPelajaran->currentPage()-1) * $mataPelajaran->perPage() }}

</td>

<td>{{ $item->kode }}</td>

<td>{{ $item->nama }}</td>

<td>{{ $item->kelompok }}</td>

<td>

<a href="{{ route('mata-pelajaran.edit',$item->id) }}"
class="btn btn-warning btn-sm">

Edit

</a>

<form
action="{{ route('mata-pelajaran.destroy',$item->id) }}"
method="POST"
class="d-inline">

@csrf
@method('DELETE')

<button
onclick="return confirm('Hapus data?')"
class="btn btn-danger btn-sm">

Hapus

</button>

</form>

</td>

</tr>

@empty

<tr>

<td colspan="5" class="text-center">

Belum ada data

</td>

</tr>

@endforelse

</tbody>

</table>

{{ $mataPelajaran->links() }}

</div>

</div>

</div>

@endsection
