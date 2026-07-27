            @extends('dashboard.layout')

            @section('content')
                <div class="container-fluid">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">
                                Pembagian Siswa
                            </h4>
                        </div>
                    <div class="card-body">
                    <div class="row">

                <div class="col-md-4">
                    <label>Tahun Pelajaran</label>
                    <select class="form-control" id="tahun">
                        @if($tahun)
                            <option value="{{ $tahun->id }}">
                                {{ $tahun->nama }}
                            </option>
                        @endif
                    </select>
                </div>

                <div class="col-md-4">
                    <label>Tingkat</label>

                    <select class="form-control" id="tingkat">
                        <option value="">Pilih Tingkat</option>
                        <option value="VII">VII</option>
                        <option value="VIII">VIII</option>

                        <option value="IX">IX</option>

                    </select>

                </div>

                <div class="col-md-4">

                    <label>Kelas</label>

                    <select class="form-control" id="kelas">

                        <option value="">
                            Pilih Kelas
                        </option>

                        @foreach($kelas as $k)

                        <option
                            value="{{ $k->id }}"
                            data-tingkat="{{ $k->tingkat }}">

                            {{ $k->tingkat }} {{ $k->nama_kelas }}

                        </option>

                        <div class="row mt-4">

            <div class="col-md-6">

                <div class="card">

                    <div class="card-header bg-warning">

                        <b>Siswa Belum Masuk Kelas</b>

                    </div>

                    <div class="card-body">

                        <div id="belumMasuk">

                            <center class="text-muted">

                                Pilih kelas terlebih dahulu

                            </center>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-md-6">

                <div class="card">

                    <div class="card-header bg-success text-white">

                        <b>Siswa Dalam Kelas</b>

                    </div>

                    <div class="card-body">

                        <div id="sudahMasuk">

                            <center class="text-muted">

                                Belum ada data

                            </center>

                        </div>

                    </div>

                </div>

            </div>

        </div>

                        @endforeach

                    </select>

                </div>

            </div>

            @push('scripts')
    <script>

    document
    .getElementById('tingkat')
    .addEventListener('change',function(){

        let tingkat=this.value;

        let kelas=document.querySelectorAll('#kelas option');

        kelas.forEach(function(item){

            if(item.value=="") return;

            if(item.dataset.tingkat==tingkat){

                item.hidden=false;

            }else{

                item.hidden=true;

            }

        });

    });

    </script>
    @endpush

            @endsection