@extends('dashboard.layout')
@include('dashboard.components.alert')

@section('content')
<div class="container">
    <h1>Manajemen User</h1>
    
    @include('dashboard.components.button',[
    'href'=>route('users.create'),
    'type'=>'primary',
    'icon'=>'fas fa-plus',
    'text'=>'Tambah User'
])
        @include('dashboard.components.search',[
        'action'=>route('users.index'),
        'placeholder'=>'Cari nama, username atau email...'
        ])
    

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                    <th>Status</th>
                    <th>Login Terakhir</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $item)
                <tr>
                    <td>{{ $users->firstItem() + $loop->index }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->email }}</td>
                    <td>
                        @if($item->role == 'admin')

                    @include('dashboard.components.badge',[
                    'type'=>'danger',
                    'text'=>'Admin'
                    ])

                    @elseif($item->role == 'guru')

                    @include('dashboard.components.badge',[
                    'type'=>'success',
                    'text'=>'Guru'
                    ])

                    @else

                    @include('dashboard.components.badge',[
                    'type'=>'primary',
                    'text'=>'Siswa'
                    ])

                    @endif
                    </td>
                    <td>
                        @include('dashboard.components.button',[
                        'href'=>route('users.edit',$item->id),
                        'type'=>'warning',
                        'icon'=>'fas fa-edit',
                        'text'=>'Edit'
                        ])

                        <form action="{{ route('users.destroy', $item->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                    <td>

                @if($item->is_active)

                @include('dashboard.components.badge',[
                'type'=>'success',
                'text'=>'Aktif'
                ])

                @else

                @include('dashboard.components.badge',[
                'type'=>'secondary',
                'text'=>'Nonaktif'
                ])

                @endif
</td>

<td>

{{ $item->last_login_at
    ? $item->last_login_at->format('d-m-Y H:i')
    : '-' }}

</td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">Belum ada user</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">
    {{ $users->links() }}
</div>
    </div>
</div>
@endsection