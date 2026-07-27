<form method="GET" action="{{ $action }}" class="mb-4">

    <div class="row g-2">

        <div class="col-md-4">

            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="{{ $placeholder }}"
                value="{{ request('search') }}">

        </div>

        <div class="col-md-2">

            <select name="role" class="form-select">

                <option value="">Semua Role</option>

                <option value="admin"
                    {{ request('role')=='admin'?'selected':'' }}>
                    Admin
                </option>

                <option value="guru"
                    {{ request('role')=='guru'?'selected':'' }}>
                    Guru
                </option>

                <option value="siswa"
                    {{ request('role')=='siswa'?'selected':'' }}>
                    Siswa
                </option>

            </select>

        </div>

        <div class="col-md-2">

            <select name="status" class="form-select">

                <option value="">Semua Status</option>

                <option value="1"
                    {{ request('status')==='1'?'selected':'' }}>
                    Aktif
                </option>

                <option value="0"
                    {{ request('status')==='0'?'selected':'' }}>
                    Nonaktif
                </option>

            </select>

        </div>

        <div class="col-md-2">

            <button class="btn btn-primary w-100">

                <i class="fas fa-search"></i>

                Cari

            </button>

        </div>

        <div class="col-md-2">

            <a href="{{ $action }}"
               class="btn btn-secondary w-100">

                Reset

            </a>

        </div>

    </div>

</form>