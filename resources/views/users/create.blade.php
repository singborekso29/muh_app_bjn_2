@extends('dashboard.layout')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">
            Tambah User
        </h4>
    </div>
    <hr>
    
    
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif
<div class="card-body">
    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                   value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
    <label>Username <span class="text-danger">*</span></label>

    <input
        type="text"
        name="username"
        class="form-control @error('username') is-invalid @enderror"
        value="{{ old('username') }}"
        required>

    @error('username')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

        <div class="mb-3">
            <label>Email <span class="text-danger">*</span></label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                   value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Password <span class="text-danger">*</span></label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Konfirmasi Password <span class="text-danger">*</span></label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Role <span class="text-danger">*</span></label>
            <select name="role" class="form-control @error('role') is-invalid @enderror" required>
                <option value="">-- Pilih Role --</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                <option value="siswa" {{ old('role') == 'siswa' ? 'selected' : '' }}>Siswa</option>
            </select>
            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
    <label>Status User <span class="text-danger">*</span></label>

    <select
        name="is_active"
        class="form-select @error('is_active') is-invalid @enderror"
        required>

        <option value="1" {{ old('is_active',1)==1 ? 'selected' : '' }}>
            Aktif
        </option>

        <option value="0" {{ old('is_active')==='0' ? 'selected' : '' }}>
            Nonaktif
        </option>

    </select>

    @error('is_active')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
</div>
@endsection