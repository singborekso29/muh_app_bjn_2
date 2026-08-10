@extends('dashboard.layout')
@include('dashboard.components.alert')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Data Siswa</h1>
            <div>
                @if(auth()->user()->role == 'admin')
                    <a href="{{ route('siswa.create') }}" class="btn btn-primary me-2">
                        <i class="fas fa-plus"></i> Tambah Siswa
                    </a>
                @endif

                <a href="{{ route('siswa.cetak-semua') }}" class="btn btn-danger" target="_blank">
                    <i class="fas fa-file-pdf"></i> Cetak Semua PDF
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table id="tabel-siswa" class="table table-bordered table-hover w-100">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>NIS/NISN</th>
                        <th>Kelas</th>
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
            const table = $('#tabel-siswa').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('siswa.index') }}",
                    type: "GET"
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'foto', name: 'foto', orderable: false, searchable: false },
                    { data: 'nama', name: 'nama' },
                    { data: 'nisn', name: 'nisn', render: (d) => d ?? '-' },
                    { data: 'kelas', name: 'kelas', render: (d) => d ?? '-' },
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

            // Hapus siswa via AJAX (tombol dirender dari kolom 'aksi' di controller)
            $('#tabel-siswa').on('click', '.btn-hapus-siswa', function () {
                const id = $(this).data('id');
                const nama = $(this).data('nama');

                if (!confirm('Yakin ingin menghapus data siswa "' + nama + '"?')) {
                    return;
                }

                $.ajax({
                    url: '{{ url("/siswa") }}/' + id,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE'
                    },
                    success: function () {
                        table.ajax.reload(null, false);
                    },
                    error: function () {
                        alert('Gagal menghapus data siswa. Silakan coba lagi.');
                    }
                });
            });
        });
    </script>
@endsection