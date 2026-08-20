@extends('dashboard.layout')

@include('dashboard.components.alert')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h1>Manajemen User</h1>

        @if(auth()->user()->role == 'admin')

            <a href="{{ route('users.create') }}"
               class="btn btn-primary">

                <i class="fas fa-plus"></i>
                Tambah User

            </a>

        @endif

    </div>


    <div class="table-responsive">

        <table id="tabel-user"
               class="table table-bordered table-hover w-100">

            <thead class="table-dark">

                <tr>

                    <th>No</th>

                    <th>Nama</th>

                    <th>Username</th>

                    <th>Email</th>

                    <th>Role</th>

                    <th>Status</th>

                    <th>Login Terakhir</th>

                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody></tbody>

        </table>

    </div>

</div>

@endsection


@section('scripts')

<link rel="stylesheet"
      href="https://cdn.datatables.net/1.13.11/css/dataTables.bootstrap5.min.css">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.datatables.net/1.13.11/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.11/js/dataTables.bootstrap5.min.js"></script>


<script>

$(function () {

    const table = $('#tabel-user').DataTable({

        processing: true,

        serverSide: true,

        ajax: {

            url: "{{ route('users.index') }}",

            type: "GET"

        },

        columns: [

            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },

            {
                data: 'name',
                name: 'name'
            },

            {
                data: 'username',
                name: 'username'
            },

            {
                data: 'email',
                name: 'email'
            },

            {
                data: 'role',
                name: 'role',
                orderable: false
            },

            {
                data: 'status',
                name: 'status',
                orderable: false,
                searchable: false
            },

            {
                data: 'last_login',
                name: 'last_login_at'
            },

            {
                data: 'aksi',
                name: 'aksi',
                orderable: false,
                searchable: false
            }

        ],

        order: [
            [1, 'asc']
        ],

        pageLength: 10,

        language: {

            processing: "Memuat data...",

            search: "Cari:",

            lengthMenu: "Tampilkan _MENU_ data",

            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",

            infoEmpty: "Tidak ada data",

            infoFiltered: "(disaring dari _MAX_ total data)",

            zeroRecords: "Data tidak ditemukan",

            emptyTable: "Belum ada data user",

            paginate: {

                first: "Awal",

                last: "Akhir",

                next: "Selanjutnya",

                previous: "Sebelumnya"

            }

        }

    });


    // =========================================
    // HAPUS USER
    // =========================================

    $('#tabel-user').on(
        'click',
        '.btn-hapus-user',
        function () {

            const id = $(this).data('id');

            const nama = $(this).data('nama');

            if (!confirm(
                'Yakin ingin menghapus user "' +
                nama +
                '"?'
            )) {

                return;

            }

            $.ajax({

                url: '{{ url("/users") }}/' + id,

                type: 'POST',

                data: {

                    _token: '{{ csrf_token() }}',

                    _method: 'DELETE'

                },

                success: function () {

                    table.ajax.reload(null, false);

                },

                error: function (xhr) {

                    alert(
                        'Gagal menghapus user. Silakan coba lagi.'
                    );

                    console.log(xhr.responseText);

                }

            });

        }
    );

});

</script>

@endsection