<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Login ke Sistem Informasi Sekolah - Masuk dengan akun Anda untuk mengakses dashboard.">
    <title>Login — Sistem Informasi Sekolah</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"> 
      @vite (['resources/css/login.css', 'resources/js/app.js'])
   <style>
        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #818cf8;
            --accent: #06b6d4;
            --danger: #ef4444;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --bg: #0f172a;
            --card-bg: rgba(255, 255, 255, 0.05);
            --border: rgba(255, 255, 255, 0.1);
            --input-bg: rgba(255, 255, 255, 0.07);
            --input-border: rgba(255, 255, 255, 0.15);
            --input-focus: rgba(99, 102, 241, 0.5);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Animated background blobs */
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
            animation-delay: 0s;
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

        /* Grid pattern overlay */
        .grid-overlay {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
        }

        /* Card */
        .login-card {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 440px;
            margin: 20px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 48px 40px;
            box-shadow:
                0 25px 50px rgba(0, 0, 0, 0.5),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
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

        /* Logo / Header */
        .login-header {
            text-align: center;
            margin-bottom: 36px;
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

        .login-title {
            font-size: 26px;
            font-weight: 700;
            color: #f1f5f9;
            letter-spacing: -0.5px;
            margin-bottom: 6px;
        }

        .login-subtitle {
            font-size: 14px;
            color: #94a3b8;
            font-weight: 400;
        }

        /* Alert: session status */
        .alert-success {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #6ee7b7;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 13px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Alert: error */
        .alert-error {
            background: rgba(239, 68, 68, 0.12);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        /* Form */
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

        .form-input:focus+.input-icon,
        .input-wrapper:focus-within .input-icon {
            color: #818cf8;
        }

        .input-icon {
            z-index: 1;
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

        .field-error {
            font-size: 12px;
            color: #fca5a5;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Remember & Forgot */
        .form-footer-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
        }

        .remember-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-size: 13px;
            color: #94a3b8;
            user-select: none;
        }

        .remember-label input[type="checkbox"] {
            appearance: none;
            -webkit-appearance: none;
            width: 16px;
            height: 16px;
            border: 1.5px solid rgba(255, 255, 255, 0.2);
            border-radius: 4px;
            background: rgba(255, 255, 255, 0.05);
            cursor: pointer;
            position: relative;
            transition: all 0.2s;
            flex-shrink: 0;
        }

        .remember-label input[type="checkbox"]:checked {
            background: #6366f1;
            border-color: #6366f1;
        }

        .remember-label input[type="checkbox"]:checked::after {
            content: '';
            position: absolute;
            left: 4px;
            top: 1px;
            width: 5px;
            height: 9px;
            border: 2px solid white;
            border-top: none;
            border-left: none;
            transform: rotate(45deg);
        }

        .forgot-link {
            font-size: 13px;
            color: #818cf8;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .forgot-link:hover {
            color: #a5b4fc;
            text-decoration: underline;
        }

        /* Submit button */
        .btn-login {
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

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.15), transparent);
            transition: left 0.5s;
        }

        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 28px rgba(99, 102, 241, 0.55);
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:active {
            transform: translateY(0);
            box-shadow: 0 4px 16px rgba(99, 102, 241, 0.4);
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 28px 0 0;
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

        /* Footer */
        .login-card-footer {
            text-align: center;
            margin-top: 28px;
            font-size: 13px;
            color: #475569;
        }

        .login-card-footer strong {
            color: #818cf8;
            font-weight: 500;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-card {
                padding: 36px 24px;
            }

            .login-title {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>
    <!-- Background effects -->
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>
    <div class="grid-overlay"></div>

    <!-- Login Card -->
    <div class="login-card">
        

        <!-- Header -->
        <div class="login-header">
            <div class="logo-icon">
                <!-- Graduation cap icon -->
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
                    <path d="M6 12v5c3 3 9 3 12 0v-5" />
                </svg>
            </div>
            <h1 class="login-title">Selamat Datang</h1>
            <p class="login-subtitle">Di Sistem Informasi</p>
            <p class="login-subtitle"> SMP MUHAMMADIYAH BOJONG NANGKA</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="alert-success">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ session('status') }}
            </div>
        @endif

        <!-- General Error -->
        @if ($errors->any())
            <div class="alert-error">
                ⚠️ {{ $errors->first() }}
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

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
                        value="{{ old('email') }}" required autofocus autocomplete="username">
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

            <!-- Password -->
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <div class="input-wrapper">
                    <svg class="input-icon" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <input id="password" type="password" name="password" class="form-input" placeholder="••••••••"
                        required autocomplete="current-password" style="padding-right: 44px;">
                    <button type="button" class="toggle-password" onclick="togglePassword()"
                        aria-label="Tampilkan password" id="toggle-btn">
                        <!-- Eye icon -->
                        <svg id="eye-icon" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
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

            <!-- Remember Me & Forgot Password -->
            <div class="form-footer-row">
                <label class="remember-label" for="remember_me">
                    <input id="remember_me" type="checkbox" name="remember">
                    Ingat saya
                </label>

                @if (Route::has('password.request'))
                    <a class="forgot-link" href="{{ route('password.request') }}">Lupa password?</a>
                @endif
            </div>

            <!-- Submit -->
            <button type="submit" class="btn-login" id="login-btn">
                Masuk
            </button>
        </form>

        <!-- Link ke Register -->
        {{-- @if (Route::has('register'))
            <div style="text-align: center; margin-top: 20px; font-size: 13px; color: #64748b;">
                Belum punya akun? &nbsp;
                <a href="{{ route('register') }}"
                    style="color: #818cf8; text-decoration: none; font-weight: 500; transition: color 0.2s;"
                    onmouseover="this.style.color='#a5b4fc'; this.style.textDecoration='underline';"
                    onmouseout="this.style.color='#818cf8'; this.style.textDecoration='none';">
                    Daftar di sini
                </a>
            </div>
        @endif --}}

        <div class="divider"><span>Sistem Informasi Sekolah</span></div>

        <div class="login-card-footer">
            &copy; {{ date('Y') }} &nbsp;<strong>MUH_BJN</strong> &nbsp;— Hak cipta dilindungi
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            const isHidden = input.type === 'password';

            input.type = isHidden ? 'text' : 'password';

            icon.innerHTML = isHidden
                ? `<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`
                : `<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
        }
    </script>
</body>

</html>