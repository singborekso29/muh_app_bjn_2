<div class="bg-dark text-white p-3 vh-100" style="width:250px;">
    <h5><i class="fas fa-bars"></i> MENU</h5>
    <hr>

    <ul class="nav flex-column">
        <!-- Dashboard -->
        <li class="nav-item mb-2">
            <a href="/dashboard" class="nav-link text-white">
                <i class="fas fa-home"></i> Dashboard
            </a>
        </li>

        @auth
            @php
                $user = Auth::user();
            @endphp

            @if($user->role == 'admin')
                <!-- ============================================ -->
                <!-- MENU UNTUK ADMIN -->
                <!-- ============================================ -->

                <!-- MASTER DATA -->
                <li class="nav-header text-uppercase text-secondary mt-3 mb-2" style="font-size: 12px;">
                    <i class="fas fa-database"></i> MASTER DATA
                </li>

                <li class="nav-item mb-2">
                    <a href="{{ route('users.index') }}" class="nav-link text-white">
                        <i class="fas fa-users"></i> Manajemen User
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a href="{{ route('guru.index') }}" class="nav-link text-white">
                        <i class="fas fa-chalkboard-teacher"></i> Data Guru
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a href="{{ route('siswa.index') }}" class="nav-link text-white">
                        <i class="fas fa-user-graduate"></i> Data Siswa
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a href="{{ route('kelas.index') }}" class="nav-link text-white">
                        <i class="fas fa-school"></i> Data Kelas
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a href="{{ route('tahun-pelajaran.index') }}" class="nav-link text-white">
                        <i class="fas fa-calendar-alt"></i> Tahun Pelajaran
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a href="{{ route('mata-pelajaran.index') }}" class="nav-link text-white">
                        <i class="fas fa-book"></i> Mata Pelajaran
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a href="{{ route('pembagian-kelas.index') }}" class="nav-link text-white">
                        <i class="fas fa-users"></i> Pembagian Kelas
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('pembagian-kelas.rekap') }}" class="nav-link text-white">
                        <i class="fas fa-list-check"></i> Rekap Siswa per Kelas
                    </a>
                </li>

                <!-- AKADEMIK -->
                <li class="nav-header text-uppercase text-secondary mt-3 mb-2" style="font-size: 12px;">
                    <i class="fas fa-graduation-cap"></i> AKADEMIK
                </li>

                <li class="nav-item mb-2">
                    <a href="#" class="nav-link text-white" onclick="return false;">
                        <i class="fas fa-users-class"></i> Akademik
                        <i class="fas fa-chevron-right float-end"></i>
                    </a>
                </li>

                <!-- PENILAIAN -->
                <li class="nav-header text-uppercase text-secondary mt-3 mb-2" style="font-size: 12px;">
                    <i class="fas fa-clipboard-check"></i> PENILAIAN
                </li>

                <li class="nav-item mb-2">
                    <a href="#" class="nav-link text-white" onclick="return false;">
                        <i class="fas fa-clipboard-check"></i> Penilaian
                        <i class="fas fa-chevron-right float-end"></i>
                    </a>
                </li>

                <!-- ADMINISTRASI -->
                <li class="nav-header text-uppercase text-secondary mt-3 mb-2" style="font-size: 12px;">
                    <i class="fas fa-folder"></i> ADMINISTRASI
                </li>

                <li class="nav-item mb-2">
                    <a href="#" class="nav-link text-white" onclick="return false;">
                        <i class="fas fa-folder"></i> Administrasi
                        <i class="fas fa-chevron-right float-end"></i>
                    </a>
                </li>

            @elseif($user->role == 'guru')
                <!-- ============================================ -->
                <!-- MENU UNTUK GURU -->
                <!-- ============================================ -->

                <li class="nav-item mb-2">
                    <a href="{{ route('siswa.index') }}" class="nav-link text-white">
                        <i class="fas fa-user-graduate"></i> Data Siswa
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a href="{{ route('guru.index') }}" class="nav-link text-white">
                        <i class="fas fa-chalkboard-teacher"></i> Data Guru
                    </a>
                </li>

            @else
                <!-- ============================================ -->
                <!-- MENU UNTUK SISWA -->
                <!-- ============================================ -->

                <li class="nav-item mb-2">
                    <a href="{{ route('siswa.index') }}" class="nav-link text-white">
                        <i class="fas fa-user-graduate"></i> Data Siswa
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a href="{{ route('siswa.profile') }}" class="nav-link text-white">
                        <i class="fas fa-user"></i> Profil Saya
                    </a>
                </li>

            @endif
        @endauth

        <!-- Logout -->
        <li class="nav-item mt-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger w-100">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </li>
    </ul>
</div>

<style>
.nav-link:hover {
    background-color: rgba(255,255,255,0.1);
    border-radius: 5px;
}

.nav-header {
    font-weight: bold;
    letter-spacing: 0.5px;
    border-bottom: 1px solid rgba(255,255,255,0.1);
    padding-bottom: 5px;
}

.nav-link i {
    width: 20px;
    text-align: center;
}

.nav-item {
    transition: all 0.2s;
}

.nav-item:hover {
    transform: translateX(5px);
}

.btn-danger:hover {
    background-color: #c82333;
}

</style>