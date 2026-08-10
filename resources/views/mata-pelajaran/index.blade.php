@extends('dashboard.layout')

@section('content')

    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3><i class="fas fa-book text-primary"></i> Master Mata Pelajaran</h3>
            @if(auth()->user()->role == 'admin')
                <a href="{{ route('mata-pelajaran.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Mata Pelajaran
                </a>
            @endif
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table id="tabel-mapel" class="table table-bordered table-hover w-100">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Mata Pelajaran</th>
                        <th>Kelompok</th>
                        <th>Jam Pelajaran</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

    </div>

@endsection

@section('scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.11/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.11/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.11/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(function () {
            const table = $('#tabel-mapel').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('mata-pelajaran.index') }}",
                    type: "GET"
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'kode_mapel', name: 'kode_mapel' },
                    { data: 'nama_mapel', name: 'nama_mapel' },
                    { data: 'kelompok', name: 'kelompok', render: (d) => d ?? '-' },
                    { data: 'jam_pelajaran', name: 'jam_pelajaran', render: (d) => d + ' JP' },
                    { data: 'status', name: 'is_active', orderable: false },
                    { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
                ],
                order: [[2, 'asc']],
                language: {
                    processing: "Memuat data...",
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data",
                    infoFiltered: "(disaring dari _MAX_ total data)",
                    zeroRecords: "Data tidak ditemukan",
                    paginate: { first: "Awal", last: "Akhir", next: "Selanjutnya", previous: "Sebelumnya" }
                }
            });

            // Hapus mata pelajaran via AJAX
            $('#tabel-mapel').on('click', '.btn-hapus-mapel', function () {
                const id = $(this).data('id');
                const nama = $(this).data('nama');

                if (!confirm('Yakin ingin menghapus mata pelajaran "' + nama + '"?')) {
                    return;
                }

                $.ajax({
                    url: '{{ url("/mata-pelajaran") }}/' + id,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE'
                    },
                    success: function () {
                        table.ajax.reload(null, false);
                    },
                    error: function () {
                        alert('Gagal menghapus data. Silakan coba lagi.');
                    }
                });
            });
        });
    </script>
@endsection