@extends('dashboard.layout')

@section('content')


    <div class="app-content">
        <div class="container-fluid">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1">Dashboard</h2>
                    <p class="text-muted mb-0">
                        Selamat datang di Sistem Informasi Sekolah SMP Muhammadiyah Bojong Nangka.
                    </p>
                </div>
            </div>

            <div class="row g-4">

                <!-- Card Guru -->
                <div class="col-lg-3 col-md-6">
                    <div class="small-box bg-primary shadow-sm rounded-4 p-3 position-relative overflow-hidden">

                        <div class="inner">
                            <h3 class="fw-bold">{{ $totalGuru }}</h3>
                            <p class="mb-0 fs-6">Total Guru</p>
                        </div>

                        <div class="icon position-absolute top-0 end-0 p-3 opacity-25">
                            <i class="bi bi-person-badge fs-1"></i>
                        </div>

                        <a href="#" class="small-box-footer text-white text-decoration-none d-block mt-3">
                            Lihat Detail
                            <i class="bi bi-arrow-right-circle ms-1"></i>
                        </a>

                    </div>
                </div>

                <!-- Card Siswa -->
                <div class="col-lg-3 col-md-6">
                    <div class="small-box bg-success shadow-sm rounded-4 p-3 position-relative overflow-hidden">

                        <div class="inner">
                            <h3 class="fw-bold">{{ $totalSiswa }}</h3>
                            <p class="mb-0 fs-6">Total Siswa</p>
                        </div>

                        <div class="icon position-absolute top-0 end-0 p-3 opacity-25">
                            <i class="bi bi-people-fill fs-1"></i>
                        </div>

                        <a href="#" class="small-box-footer text-white text-decoration-none d-block mt-3">
                            Lihat Detail
                            <i class="bi bi-arrow-right-circle ms-1"></i>
                        </a>

                    </div>
                </div>

                <!-- Card User -->
                <div class="col-lg-3 col-md-10">
                    <div class="small-box bg-warning shadow-sm rounded-4 p-3 position-relative overflow-hidden">

                        <div class="inner">
                            <h3 class="fw-bold">{{ $totalUser }}</h3>
                            <p class="mb-0 fs-6">User Aktif</p>
                        </div>

                        <div class="icon position-absolute top-0 end-0 p-3 opacity-25">
                            <i class="bi bi-person-check-fill fs-1"></i>
                        </div>

                        <a href="#" class="small-box-footer text-dark text-decoration-none d-block mt-3">
                            Lihat Detail
                            <i class="bi bi-arrow-right-circle ms-1"></i>
                        </a>

                    </div>
                </div>

                <!-- Card Pengumuman -->
                <!-- <div class="col-lg-3 col-md-6">
                            <div class="small-box bg-danger shadow-sm rounded-4 p-3 position-relative overflow-hidden">

                                <div class="inner">
                                    <h3 class="fw-bold">12</h3>
                                    <p class="mb-0 fs-6">Pengumuman</p>
                                </div>

                                <div class="icon position-absolute top-0 end-0 p-3 opacity-25">
                                    <i class="bi bi-megaphone-fill fs-1"></i>
                                </div>

                                <a href="#" class="small-box-footer text-white text-decoration-none d-block mt-3">
                                    Lihat Detail
                                    <i class="bi bi-arrow-right-circle ms-1"></i>
                                </a>

                            </div> -->
            </div>

        </div>

    </div>
    </div>

@endsection