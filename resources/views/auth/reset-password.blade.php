<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Reset password akun Sistem Informasi SMP Muhammadiyah Bojong Nangka.">
    <title>Reset Password — Sistem Informasi Sekolah</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #0f172a;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.35;
            animation: float 8s ease-in-out infinite;
        }

        .blob-1 {
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, #6366f1, #4f46e5);
            top: -150px;
            left: -150px;
        }

        .blob-2 {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, #06b6d4, #0891b2);
            bottom: -100px;
            right: -100px;
            animation-delay: 3s;
        }

        .blob-3 {
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, #8b5cf6, #7c3aed);
            top: 50%;
            left: 60%;
            animation-delay: 5s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(15px, -20px) scale(1.05);
            }

            66% {
                transform: translate(-10px, 10px) scale(0.98);
            }
        }

        .grid-overlay {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
        }

        .card {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 460px;
            margin: 20px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 48px 40px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5), inset 0 1px 0 rgba(255, 255, 255, 0.1);
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .logo-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #6366f1, #06b6d4);
            border-radius: 18px;
            margin-bottom: 20px;
            box-shadow: 0 8px 32px rgba(99, 102, 241, 0.4);
            animation: pulse-glow 3s ease-in-out infinite;
        }

        @keyframes pulse-glow {

            0%,
            100% {
                box-shadow: 0 8px 32px rgba(99, 102, 241, 0.4);
            }

            50% {
                box-shadow: 0 8px 48px rgba(99, 102, 241, 0.7);
            }
        }

        .logo-icon svg {
            width: 32px;
            height: 32px;
            color: white;
        }

        .card-title {
            font-size: 24px;
            font-weight: 700;
            color: #f1f5f9;
            letter-spacing: -0.5px;
            margin-bottom: 6px;
        }

        .card-subtitle {
            font-size: 13px;
            color: #94a3b8;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: #cbd5e1;
            margin-bottom: 8px;
            letter-spacing: 0.3px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            pointer-events: none;
            transition: color 0.2s;
            z-index: 1;
        }

        .form-input {
            width: 100%;
            padding: 13px 14px 13px 42px;
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 12px;
            color: #f1f5f9;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            transition: all 0.25s ease;
            outline: none;
        }

        .form-input::placeholder {
            color: #475569;
        }

        .form-input:focus {
            border-color: rgba(99, 102, 241, 0.6);
            background: rgba(99, 102, 241, 0.08);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        }

        .input-wrapper:focus-within .input-icon {
            color: #818cf8;
        }

        /* Password toggle */
        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #64748b;
            cursor: pointer;
            padding: 2px;
            display: flex;
            transition: color 0.2s;
        }

        .toggle-password:hover {
            color: #94a3b8;
        }

        /* Strength bar */
        .strength-bar {
            display: flex;
            gap: 4px;
            margin-top: 8px;
        }

        .strength-segment {
            flex: 1;
            height: 3px;
            border-radius: 2px;
            background: rgba(255, 255, 255, 0.08);
            transition: background 0.3s;
        }

        .strength-label {
            font-size: 11px;
            color: #64748b;
            margin-top: 4px;
            min-height: 16px;
        }

        .field-error {
            font-size: 12px;
            color: #fca5a5;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .btn-primary {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(99, 102, 241, 0.4);
            letter-spacing: 0.3px;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.15), transparent);
            transition: left 0.5s;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 28px rgba(99, 102, 241, 0.55);
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 24px 0 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255, 255, 255, 0.08);
        }

        .divider span {
            font-size: 12px;
            color: #475569;
        }

        .card-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: #475569;
        }

        .card-footer strong {
            color: #818cf8;
            font-weight: 500;
        }

        @media (max-width: 480px) {
            .card {
                padding: 36px 24px;
            }

            .card-title {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>
    <div class="grid-overlay"></div>

    <div class="card">
        <div class="card-header">
            <div class="logo-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                    <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                </svg>
            </div>
            <h1 class="card-title">Reset Password</h1>
            <p class="card-subtitle">SMP MUHAMMADIYAH BOJONG NANGKA</p>
        </div>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email -->
            <div class="form-group">
                <label class="form-label" for="email">Alamat Email</label>
                <div class="input-wrapper">
                    <svg class="input-icon" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <input id="email" type="email" name="email" class="form-input" placeholder="nama@sekolah.sch.id"
                        value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
                </div>
                @error('email')
                    <p class="field-error">
                        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Password Baru -->
            <div class="form-group">
                <label class="form-label" for="password">Password Baru</label>
                <div class="input-wrapper">
                    <svg class="input-icon" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <input id="password" type="password" name="password" class="form-input"
                        placeholder="Min. 8 karakter" required autocomplete="new-password" style="padding-right: 44px;"
                        oninput="checkStrength(this.value)">
                    <button type="button" class="toggle-password" onclick="togglePass('password','eye1')"
                        aria-label="Tampilkan password">
                        <svg id="eye1" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
                <div class="strength-bar">
                    <div class="strength-segment" id="seg1"></div>
                    <div class="strength-segment" id="seg2"></div>
                    <div class="strength-segment" id="seg3"></div>
                    <div class="strength-segment" id="seg4"></div>
                </div>
                <div class="strength-label" id="strength-label"></div>
                @error('password')
                    <p class="field-error">
                        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Konfirmasi Password -->
            <div class="form-group">
                <label class="form-label" for="password_confirmation">Konfirmasi Password Baru</label>
                <div class="input-wrapper">
                    <svg class="input-icon" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-input"
                        placeholder="Ulangi password baru" required autocomplete="new-password"
                        style="padding-right: 44px;">
                    <button type="button" class="toggle-password" onclick="togglePass('password_confirmation','eye2')"
                        aria-label="Tampilkan konfirmasi">
                        <svg id="eye2" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
                @error('password_confirmation')
                    <p class="field-error">
                        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <button type="submit" class="btn-primary">
                Simpan Password Baru
            </button>
        </form>

        <div class="divider"><span>Sistem Informasi Sekolah</span></div>
        <div class="card-footer">
            &copy; {{ date('Y') }} &nbsp;<strong>MUH_BJN</strong> &nbsp;— Hak cipta dilindungi
        </div>
    </div>

    <script>
        function togglePass(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';
            icon.innerHTML = isHidden
                ? `<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`
                : `<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
        }

        function checkStrength(val) {
            const segs = ['seg1', 'seg2', 'seg3', 'seg4'].map(id => document.getElementById(id));
            const label = document.getElementById('strength-label');
            const colors = ['#ef4444', '#f97316', '#eab308', '#22c55e'];
            const labels = ['Sangat Lemah', 'Lemah', 'Cukup', 'Kuat'];
            let score = 0;
            if (val.length >= 8) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;
            segs.forEach((s, i) => {
                s.style.background = val.length === 0
                    ? 'rgba(255,255,255,0.08)'
                    : (i < score ? colors[score - 1] : 'rgba(255,255,255,0.08)');
            });
            label.textContent = val.length === 0 ? '' : (labels[score - 1] ?? 'Sangat Lemah');
            label.style.color = val.length === 0 ? '#64748b' : (colors[score - 1] ?? '#ef4444');
        }
    </script>
</body>

</html>