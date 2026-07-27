@extends('dashboard.layout')

@section('content')

<div class="container">
    <h1>Edit Guru</h1>
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

    @include('dashboard.components.search',[
'action'=>route('guru.index'),
'placeholder'=>'Cari guru...'
])
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Nama <span class="text-danger">*</span></label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                           value="{{ old('nama', $guru->nama) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label>NIP <span class="text-danger">*</span></label>
                    <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" 
                           value="{{ old('nip', $guru->nip) }}" required>
                    @error('nip')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Tempat Lahir <span class="text-danger">*</span></label>
                    <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" 
                           value="{{ old('tempat_lahir', $guru->tempat_lahir) }}" required>
                    @error('tempat_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Tanggal Lahir <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                           value="{{ old('tanggal_lahir', $guru->tanggal_lahir) }}" required>
                    @error('tanggal_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Jenis Kelamin <span class="text-danger">*</span></label>
                    <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Agama <span class="text-danger">*</span></label>
                    <select name="agama" class="form-control @error('agama') is-invalid @enderror" required>
                        <option value="">-- Pilih Agama --</option>
                        <option value="Islam" {{ old('agama', $guru->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                        <option value="Kristen" {{ old('agama', $guru->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                        <option value="Katolik" {{ old('agama', $guru->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                        <option value="Hindu" {{ old('agama', $guru->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                        <option value="Budha" {{ old('agama', $guru->agama) == 'Budha' ? 'selected' : '' }}>Budha</option>
                    </select>
                    @error('agama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Pendidikan Terakhir <span class="text-danger">*</span></label>
                    <select name="pendidikan_terakhir" class="form-control @error('pendidikan_terakhir') is-invalid @enderror" required>
                        <option value="">-- Pilih Pendidikan --</option>
                        <option value="S1" {{ old('pendidikan_terakhir', $guru->pendidikan_terakhir) == 'S1' ? 'selected' : '' }}>S1</option>
                        <option value="S2" {{ old('pendidikan_terakhir', $guru->pendidikan_terakhir) == 'S2' ? 'selected' : '' }}>S2</option>
                        <option value="S3" {{ old('pendidikan_terakhir', $guru->pendidikan_terakhir) == 'S3' ? 'selected' : '' }}>S3</option>
                        <option value="D4" {{ old('pendidikan_terakhir', $guru->pendidikan_terakhir) == 'D4' ? 'selected' : '' }}>D4</option>
                        <option value="D3" {{ old('pendidikan_terakhir', $guru->pendidikan_terakhir) == 'D3' ? 'selected' : '' }}>D3</option>
                    </select>
                    @error('pendidikan_terakhir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Jurusan <span class="text-danger">*</span></label>
                    <input type="text" name="jurusan" class="form-control @error('jurusan') is-invalid @enderror" 
                           value="{{ old('jurusan', $guru->jurusan) }}" required>
                    @error('jurusan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Status Kepegawaian <span class="text-danger">*</span></label>
                    <select name="status_kepegawaian" class="form-control @error('status_kepegawaian') is-invalid @enderror" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="PNS" {{ old('status_kepegawaian', $guru->status_kepegawaian) == 'PNS' ? 'selected' : '' }}>PNS</option>
                        <option value="Honorer" {{ old('status_kepegawaian', $guru->status_kepegawaian) == 'Honorer' ? 'selected' : '' }}>Honorer</option>
                        <option value="GTY" {{ old('status_kepegawaian', $guru->status_kepegawaian) == 'GTY' ? 'selected' : '' }}>GTY</option>
                        <option value="Kontrak" {{ old('status_kepegawaian', $guru->status_kepegawaian) == 'Kontrak' ? 'selected' : '' }}>Kontrak</option>
                    </select>
                    @error('status_kepegawaian')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Mata Pelajaran <span class="text-danger">*</span></label>
                    <input type="text" name="mapel" class="form-control @error('mapel') is-invalid @enderror" 
                           value="{{ old('mapel', $guru->mapel) }}" required>
                    @error('mapel')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>No Telepon <span class="text-danger">*</span></label>
                    <input type="text" name="no_telepon" class="form-control @error('no_telepon') is-invalid @enderror" 
                           value="{{ old('no_telepon', $guru->no_telepon) }}" required>
                    @error('no_telepon')
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
                              rows="3" required>{{ old('alamat', $guru->alamat) }}</textarea>
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
                    @if($guru->foto && file_exists(public_path('foto_guru/' . $guru->foto)))
                        <img src="{{ asset('foto_guru/' . $guru->foto) }}" 
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
                <a href="{{ route('guru.index') }}" class="btn btn-secondary btn-lg">
                    <i class="fas fa-arrow-left"></i> Batal
                </a>
            </div>
        </div>

    </form>
</div>

@endsection