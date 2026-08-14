<div class="bg-dark text-white p-3 vh-100" style="width:280px; overflow-y: auto; position: sticky; top: 0;">
    
     <ul class="nav flex-column">
        <!-- Dashboard -->
        <li class="nav-item mb-1">
            <a href="/dashboard" class="nav-link text-white rounded">
                <i class="fas fa-home"></i> Dashboard
            </a>
        </li>

        @auth
            @php
                $user = Auth::user();
            @endphp

            @if($user->role == 'admin')
                <!-- ============================================ -->
                <!-- MASTER DATA -->
                <!-- ============================================ -->
                <li class="nav-header text-uppercase text-secondary mt-3 mb-1" style="font-size: 11px; letter-spacing: 1px;">
                    <i class="fas fa-database"></i> Master Data
                </li>

                <!-- Manajemen User -->
                <li class="nav-item mb-1">
                    <a href="{{ route('users.index') }}" class="nav-link text-white rounded">
                        <i class="fas fa-users"></i> Manajemen User
                    </a>
                </li>

                <!-- Data Guru -->
                <li class="nav-item mb-1">
                    <a href="{{ route('guru.index') }}" class="nav-link text-white rounded">
                        <i class="fas fa-chalkboard-teacher"></i> Data Guru
                    </a>
                </li>

                <!-- Data Siswa -->
                <li class="nav-item mb-1">
                    <a href="{{ route('siswa.index') }}" class="nav-link text-white rounded">
                        <i class="fas fa-user-graduate"></i> Data Siswa
                    </a>
                </li>

                <!-- Data Kelas -->
                <li class="nav-item mb-1">
                    <a href="{{ route('kelas.index') }}" class="nav-link text-white rounded">
                        <i class="fas fa-school"></i> Data Kelas
                    </a>
                </li>

                <!-- Tahun Pelajaran -->
                <li class="nav-item mb-1">
                    <a href="{{ route('tahun-pelajaran.index') }}" class="nav-link text-white rounded">
                        <i class="fas fa-calendar-alt"></i> Tahun Pelajaran
                    </a>
                </li>

                <!-- Mata Pelajaran -->
                <li class="nav-item mb-1">
                    <a href="{{ route('mata-pelajaran.index') }}" class="nav-link text-white rounded">
                        <i class="fas fa-book"></i> Mata Pelajaran
                    </a>
                </li>

                

                <!-- ============================================ -->
                <!-- AKADEMIK - Dropdown -->
                <!-- ============================================ -->
                <li class="nav-header text-uppercase text-secondary mt-3 mb-1" style="font-size: 11px; letter-spacing: 1px;">
                    <i class="fas fa-graduation-cap"></i> Akademik
                </li>

                <li class="nav-item mb-1">
                    <a class="nav-link text-white rounded" data-bs-toggle="collapse" href="#akademikMenu" role="button" aria-expanded="false" aria-controls="akademikMenu">
                        <i class="fas fa-book-open"></i> Akademik
                        <i class="fas fa-chevron-down float-end"></i>
                    </a>
                    
                    <div class="collapse" id="akademikMenu">
                        <ul class="nav flex-column ps-3">
                            <li class="nav-item mb-1">
                                <a href="{{ route('jadwal.index') }}"class="nav-link text-white rounded">
                                    <i class="fas fa-arrow-right"></i> Jadwal Pelajaran
                                </a>
                            </li>
                            <li class="nav-item mb-1">
                                <a href="#" class="nav-link text-white rounded">
                                    <i class="fas fa-arrow-right"></i> Wali Kelas
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Pembagian Kelas - Dropdown -->
                <li class="nav-item mb-1">
                    <a class="nav-link text-white rounded" data-bs-toggle="collapse" href="#pembagianKelas" role="button" aria-expanded="false" aria-controls="pembagianKelas">
                        <i class="fas fa-users"></i> Pembagian Kelas
                        <i class="fas fa-chevron-down float-end"></i>
                    </a>
                    <div class="collapse" id="pembagianKelas">
                        <ul class="nav flex-column ps-3">
                            <li class="nav-item mb-1">
                                <a href="{{ route('pembagian-kelas.index') }}" class="nav-link text-white rounded">
                                    <i class="fas fa-arrow-right"></i> Data Pembagian
                                </a>
                            </li>
                            <li class="nav-item mb-1">
                                <a href="{{ route('pembagian-kelas.rekap') }}" class="nav-link text-white rounded">
                                    <i class="fas fa-arrow-right"></i> Rekap per Kelas
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- ============================================ -->
                <!-- PENILAIAN - Dropdown -->
                <!-- ============================================ -->
                <li class="nav-header text-uppercase text-secondary mt-3 mb-1" style="font-size: 11px; letter-spacing: 1px;">
                    <i class="fas fa-clipboard-check"></i> Penilaian
                </li>

                <li class="nav-item mb-1">
                    <a class="nav-link text-white rounded" data-bs-toggle="collapse" href="#penilaianMenu" role="button" aria-expanded="false" aria-controls="penilaianMenu">
                        <i class="fas fa-clipboard-list"></i> Penilaian
                        <i class="fas fa-chevron-down float-end"></i>
                    </a>
                    <div class="collapse" id="penilaianMenu">
                        <ul class="nav flex-column ps-3">
                            <li class="nav-item mb-1">
                                <a href="#" class="nav-link text-white rounded">
                                    <i class="fas fa-arrow-right"></i> Input Nilai
                                </a>
                            </li>
                            <li class="nav-item mb-1">
                                <a href="#" class="nav-link text-white rounded">
                                    <i class="fas fa-arrow-right"></i> Rapor
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item mb-2">
                    <a class="nav-link text-white rounded" data-bs-toggle="collapse" href="#absensiMenu" role="button" aria-expanded="false" aria-controls="absensiMenu">
                        <i class="fas fa-users"></i> Absensi
                        <i class="fas fa-chevron-down float-end"></i>
                    </a>
                    <div class="collapse" id="absensiMenu">
                        <ul class="nav flex-column ps-3">
                            <li class="nav-item mb-1">
                                <a href="{{ route('absensi.index') }}" class="nav-link text-white">
                                    <i class="fas fa-clipboard-list"></i> Absensi
                                </a>
                            </li>
                            <!-- Absensi Tap / QR -->
                            <li class="nav-item mb-2">
                                <a href="{{ route('tap.index') }}" class="nav-link text-white"> Absensi Tap / QR
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a href="{{ route('absensi.create') }}" class="nav-link text-white">
                                    <i class="fas fa-clipboard-check"></i> Absen Sekarang
                                </a>
                            </li>
                            <li class="nav-item mb-1">
                                <a href="{{ route('absensi.laporan') }}" class="nav-link text-white">
                                    <i class="fas fa-file-alt"></i> Laporan Absensi
                                </a>
                            </li>
                            <li class="nav-item mb-1">
                                <a href="{{ route('absensi.rekap') }}" class="nav-link text-white">
                                    <i class="fas fa-chart-bar"></i> Rekap Absensi
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- ============================================ -->
                <!-- ADMINISTRASI - Dropdown -->
                <!-- ============================================ -->
                <li class="nav-header text-uppercase text-secondary mt-3 mb-1" style="font-size: 11px; letter-spacing: 1px;">
                    <i class="fas fa-folder"></i> Administrasi
                </li>

                <li class="nav-item mb-1">
                    <a class="nav-link text-white rounded" data-bs-toggle="collapse" href="#adminMenu" role="button" aria-expanded="false" aria-controls="adminMenu">
                        <i class="fas fa-folder-open"></i> Administrasi
                        <i class="fas fa-chevron-down float-end"></i>
                    </a>
                    <div class="collapse" id="adminMenu">
                        <ul class="nav flex-column ps-3">
                            <li class="nav-item mb-1">
                                <a href="#" class="nav-link text-white rounded">
                                    <i class="fas fa-arrow-right"></i> Surat
                                </a>
                            </li>
                            <li class="nav-item mb-1">
                                <a href="#" class="nav-link text-white rounded">
                                    <i class="fas fa-arrow-right"></i> Keuangan
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

            @elseif($user->role == 'guru')
                <!-- ============================================ -->
                <!-- MENU GURU -->
                <!-- ============================================ -->
                <li class="nav-item mb-1">
                    <a href="{{ route('siswa.index') }}" class="nav-link text-white rounded">
                        <i class="fas fa-user-graduate"></i> Data Siswa
                    </a>
                </li>

                <li class="nav-item mb-1">
                    <a href="{{ route('guru.index') }}" class="nav-link text-white rounded">
                        <i class="fas fa-chalkboard-teacher"></i> Data Guru
                    </a>
                </li>

            @else
                <!-- ============================================ -->
                <!-- MENU SISWA -->
                <!-- ============================================ -->
                <li class="nav-item mb-1">
                    <a href="{{ route('siswa.index') }}" class="nav-link text-white rounded">
                        <i class="fas fa-user-graduate"></i> Data Siswa
                    </a>
                </li>

                <li class="nav-item mb-1">
                    <a href="{{ route('siswa.profile') }}" class="nav-link text-white rounded">
                        <i class="fas fa-user"></i> Profil Saya
                    </a>
                </li>

            @endif
        @endauth

        <!-- Logout -->
        <li class="nav-item mt-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger w-100 rounded">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </li>
    </ul>
</div>

<style>
/* Sidebar Styling */
.bg-dark {
    background-color: #1a1a2e !important;
}

.nav-link {
    padding: 8px 12px;
    transition: all 0.3s ease;
    font-size: 14px;
}

.nav-link:hover {
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    transform: translateX(5px);
}

.nav-link i {
    width: 22px;
    text-align: center;
    margin-right: 8px;
}

.nav-header {
    font-weight: 600;
    letter-spacing: 0.5px;
    padding: 8px 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    margin-bottom: 4px;
}

/* Dropdown */
.collapse .nav-link {
    padding: 6px 12px 6px 30px;
    font-size: 13px;
}

.collapse .nav-link:hover {
    background-color: rgba(255, 255, 255, 0.05);
    transform: translateX(3px);
}

.collapse .nav-link i {
    width: 16px;
    font-size: 10px;
}

/* Hover effect */
.btn-danger:hover {
    background-color: #c82333;
}

/* Scrollbar */
::-webkit-scrollbar {
    width: 5px;
}

::-webkit-scrollbar-track {
    background: #1a1a2e;
}

::-webkit-scrollbar-thumb {
    background: #4a4a6a;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: #5a5a7a;
}

/* Active menu */
.nav-link.active {
    background-color: rgba(255, 255, 255, 0.15);
    border-left: 3px solid #007bff;
}
</style>