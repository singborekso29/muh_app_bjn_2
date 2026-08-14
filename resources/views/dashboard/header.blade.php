<nav class="navbar navbar-dark bg-primary px-3">
    <div class="d-flex align-items-center gap-2">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Sekolah" style="height: 40px; width: 40px; object-fit: contain;">
        <h5 class="text-white mb-0">
            SMP MUHAMMADIYAH BOJONG NANGKA</h5>
    </div>

    {{-- Informasi user yang sedang login --}}
    <div class="d-flex align-items-center text-white">
        @auth
            <div class="text-end me-3">
                <div class="fw-bold">
                    {{ auth()->user()->name }}
                </div>

                <small class="text-white-50">
                    Role:
                    {{ ucfirst(auth()->user()->role) }}
                </small>
            </div>

            <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center"
                 style="width: 40px; height: 40px; font-weight: bold;">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
        @endauth
    </div>
</nav>