@extends('dashboard.layout')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h3>Master Tahun Pelajaran</h3>

        <a href="{{ route('tahun-pelajaran.create') }}" class="btn btn-primary">
            + Tambah Tahun Pelajaran
        </a>

    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" action="{{ route('tahun-pelajaran.index') }}" class="mb-3">

        <div class="row">

            <div class="col-md-5">

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Cari Tahun Pelajaran..."
                    value="{{ request('search') }}">

            </div>

            <div class="col-md-2">

                <button class="btn btn-primary">
                    Cari
                </button>

            </div>

        </div>

    </form>

    <table class="table table-bordered table-hover">

        <thead class="table-dark">

            <tr>

                <th>No</th>

                <th>Tahun Pelajaran</th>

                <th>Semester</th>

                <th>Tanggal Mulai</th>

                <th>Tanggal Selesai</th>

                <th>Status</th>

                <th width="180">Aksi</th>

            </tr>

        </thead>

        <tbody>

        @forelse($tahunPelajaran as $item)

        <tr>

            <td>{{ $tahunPelajaran->firstItem()+$loop->index }}</td>
            <td>{{ $item->tahun }}</td>
            <td>{{ $item->semester }}</td>
            <td>{{ date('d-m-Y', strtotime($item->tanggal_mulai)) }}</td>
            <td>{{ date('d-m-Y', strtotime($item->tanggal_selesai)) }}</td>
            <td>

                @if($item->is_active)

                    <span class="badge bg-success">

                        Aktif

                    </span>

                @else

                    <span class="badge bg-secondary">

                        Tidak Aktif

                    </span>

                @endif

            </td>

            <td>

                <a href="{{ route('tahun-pelajaran.edit',$item->id) }}"
                    class="btn btn-warning btn-sm">

                    Edit

                </a>

                <form
                    action="{{ route('tahun-pelajaran.destroy',$item->id) }}"
                    method="POST"
                    class="d-inline">

                    @csrf
                    @method('DELETE')

                    <button
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('Hapus data?')">

                        Hapus

                    </button>

                </form>

            </td>

        </tr>

        @empty

        <tr>

            <td colspan="7" class="text-center">

                Belum ada data.

            </td>

        </tr>

        @endforelse

        </tbody>

    </table>

    {{ $tahunPelajaran->links() }}

</div>

@endsection