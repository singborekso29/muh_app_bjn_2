@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Edit Siswa</h1>
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

   <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" enctype="multipart/form-data">

   
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Nama <span class="text-danger">*</span></label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                           value="{{ old('nama', $siswa->nama) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label>Tempat Lahir <span class="text-danger">*</span></label>
                    <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" 
                           value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}" required>
                    @error('tempat_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Tanggal Lahir <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                           value="{{ old('tanggal_lahir', $siswa->tanggal_lahir) }}" required>
                    @error('tanggal_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>NISN <span class="text-danger">*</span></label>
                    <input type="text" name="nisn" class="form-control @error('nisn') is-invalid @enderror" 
                           value="{{ old('nisn', $siswa->nisn) }}" required>
                    @error('nisn')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>NIK <span class="text-danger">*</span></label>
                    <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" 
                           value="{{ old('nik', $siswa->nik) }}" required>
                    @error('nik')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Kelas <span class="text-danger">*</span></label>
                    <select name="kelas" class="form-control @error('kelas') is-invalid @enderror" required>
                        <option value="">-- Pilih Kelas --</option>
                        <option value="VII-A" {{ old('kelas', $siswa->kelas) == 'VII-A' ? 'selected' : '' }}>VII</option>
                        <option value="VIII-C" {{ old('kelas', $siswa->kelas) == 'VIII-C' ? 'selected' : '' }}>VIII</option>
                        <option value="IX-A" {{ old('kelas', $siswa->kelas) == 'IX-A' ? 'selected' : '' }}>IX</option>
                    </select>
                    @error('kelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Jenis Kelamin <span class="text-danger">*</span></label>
                    <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Umur <span class="text-danger">*</span></label>
                    <input type="number" name="umur" class="form-control @error('umur') is-invalid @enderror" 
                           value="{{ old('umur', $siswa->umur) }}" required>
                    @error('umur')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Agama <span class="text-danger">*</span></label>
                    <select name="agama" class="form-control @error('agama') is-invalid @enderror" required>
                        <option value="">-- Pilih Agama --</option>
                        <option value="Islam" {{ old('agama', $siswa->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                        <option value="Kristen" {{ old('agama', $siswa->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                        <option value="Katolik" {{ old('agama', $siswa->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                        <option value="Hindu" {{ old('agama', $siswa->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                        <option value="Budha" {{ old('agama', $siswa->agama) == 'Budha' ? 'selected' : '' }}>Budha</option>
                    </select>
                    @error('agama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Nama Ayah <span class="text-danger">*</span></label>
                    <input type="text" name="nama_ayah" class="form-control @error('nama_ayah') is-invalid @enderror" 
                           value="{{ old('nama_ayah', $siswa->nama_ayah) }}" required>
                    @error('nama_ayah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Pekerjaan Ayah <span class="text-danger">*</span></label>
                    <input type="text" name="pekerjaan_ayah" class="form-control @error('pekerjaan_ayah') is-invalid @enderror" 
                           value="{{ old('pekerjaan_ayah', $siswa->pekerjaan_ayah) }}" required>
                    @error('pekerjaan_ayah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Nama Ibu <span class="text-danger">*</span></label>
                    <input type="text" name="nama_ibu" class="form-control @error('nama_ibu') is-invalid @enderror" 
                           value="{{ old('nama_ibu', $siswa->nama_ibu) }}" required>
                    @error('nama_ibu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Pekerjaan Ibu <span class="text-danger">*</span></label>
                    <input type="text" name="pekerjaan_ibu" class="form-control @error('pekerjaan_ibu') is-invalid @enderror" 
                           value="{{ old('pekerjaan_ibu', $siswa->pekerjaan_ibu) }}" required>
                    @error('pekerjaan_ibu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Jumlah Saudara <span class="text-danger">*</span></label>
                    <input type="number" name="jumlah_saudara" class="form-control @error('jumlah_saudara') is-invalid @enderror" 
                           value="{{ old('jumlah_saudara', $siswa->jumlah_saudara) }}" required>
                    @error('jumlah_saudara')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Asal Sekolah <span class="text-danger">*</span></label>
                    <input type="text" name="asal_sekolah" class="form-control @error('asal_sekolah') is-invalid @enderror" 
                           value="{{ old('asal_sekolah', $siswa->asal_sekolah) }}" required>
                    @error('asal_sekolah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Diterima Di Sekolah <span class="text-danger">*</span></label>
                    <textarea name="diterima_di_sekolah" class="form-control @error('diterima_di_sekolah') is-invalid @enderror" 
                              rows="2" required>{{ old('diterima_di_sekolah', $siswa->diterima_di_sekolah) }}</textarea>
                    @error('diterima_di_sekolah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>No Ijazah <span class="text-danger">*</span></label>
                    <input type="text" name="no_ijazah" class="form-control @error('no_ijazah') is-invalid @enderror" 
                           value="{{ old('no_ijazah', $siswa->no_ijazah) }}" required>
                    @error('no_ijazah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Alamat Full Width -->
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <label>Alamat <span class="text-danger">*</span></label>
                    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" 
                              rows="3" required>{{ old('alamat', $siswa->alamat) }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Foto Full Width -->
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <label>Foto Lama</label>
                    <br>
                    @if($siswa->foto && file_exists(public_path('foto_siswa/' . $siswa->foto)))
                        <img src="{{ asset('foto_siswa/' . $siswa->foto) }}" 
                             width="150" 
                             style="object-fit: cover; border-radius: 5px;" 
                             class="mb-2">
                    @else
                        <p class="text-muted">Tidak ada foto</p>
                    @endif
                </div>

                <div class="mb-3">
                    <label>Upload Foto Baru (Opsional)</label>
                    <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti foto. Format: JPG, JPEG, PNG (Max: 2MB)</small>
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Tombol -->
        <div class="row mt-3">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save"></i> Update
                </button>
                <a href="{{ route('siswa.index') }}" class="btn btn-secondary btn-lg">
                    <i class="fas fa-arrow-left"></i> Batal
                </a>
            </div>
        </div>

</form>
</div>

@endsection