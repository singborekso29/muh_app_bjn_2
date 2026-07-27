<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Verifikasi email akun Sistem Informasi SMP Muhammadiyah Bojong Nangka.">
    <title>Verifikasi Email — Sistem Informasi Sekolah</title>
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
            margin-bottom: 28px;
        }

        .logo-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 72px;
            height: 72px;
            background: linear-gradient(135deg, #06b6d4, #0891b2);
            border-radius: 20px;
            margin-bottom: 20px;
            box-shadow: 0 8px 32px rgba(6, 182, 212, 0.4);
            animation: pulse-cyan 3s ease-in-out infinite;
        }

        @keyframes pulse-cyan {

            0%,
            100% {
                box-shadow: 0 8px 32px rgba(6, 182, 212, 0.4);
            }

            50% {
                box-shadow: 0 8px 48px rgba(6, 182, 212, 0.7);
            }
        }

        /* Envelope animation */
        .logo-icon svg {
            width: 36px;
            height: 36px;
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

        .info-box {
            background: rgba(6, 182, 212, 0.08);
            border: 1px solid rgba(6, 182, 212, 0.2);
            color: #67e8f9;
            border-radius: 12px;
            padding: 16px;
            font-size: 13px;
            line-height: 1.7;
            margin-bottom: 24px;
            text-align: center;
        }

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

        .actions {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .btn-primary {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #06b6d4, #0891b2);
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
            box-shadow: 0 4px 20px rgba(6, 182, 212, 0.4);
            letter-spacing: 0.3px;
            text-align: center;
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
            box-shadow: 0 8px 28px rgba(6, 182, 212, 0.55);
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-logout {
            width: 100%;
            padding: 13px;
            background: rgba(255, 255, 255, 0.05);
            color: #94a3b8;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.25s ease;
            letter-spacing: 0.3px;
        }

        .btn-logout:hover {
            background: rgba(239, 68, 68, 0.1);
            border-color: rgba(239, 68, 68, 0.3);
            color: #fca5a5;
        }

        .step-indicator {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-bottom: 24px;
        }

        .step {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            font-size: 12px;
            font-weight: 600;
        }

        .step.done {
            background: rgba(16, 185, 129, 0.2);
            border: 1.5px solid rgba(16, 185, 129, 0.5);
            color: #6ee7b7;
        }

        .step.active {
            background: rgba(6, 182, 212, 0.2);
            border: 1.5px solid rgba(6, 182, 212, 0.5);
            color: #67e8f9;
        }

        .step.pending {
            background: rgba(255, 255, 255, 0.04);
            border: 1.5px solid rgba(255, 255, 255, 0.1);
            color: #475569;
        }

        .step-line {
            flex: 1;
            height: 1px;
            background: rgba(255, 255, 255, 0.08);
            max-width: 40px;
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
                <!-- Email / envelope icon -->
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                    <polyline points="22,6 12,13 2,6" />
                </svg>
            </div>
            <h1 class="card-title">Verifikasi Email</h1>
            <p class="card-subtitle">SMP MUHAMMADIYAH BOJONG NANGKA</p>
        </div>

        <!-- Step indicator -->
        <div class="step-indicator">
            <div class="step done">✓</div>
            <div class="step-line"></div>
            <div class="step done">✓</div>
            <div class="step-line"></div>
            <div class="step active">3</div>
            <div class="step-line"></div>
            <div class="step pending">4</div>
        </div>

        <!-- Info -->
        <div class="info-box">
            Terima kasih sudah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengklik tautan
            yang telah kami kirimkan. Jika Anda tidak menerimanya, kami akan mengirimkan yang baru.
        </div>

        <!-- Success status -->
        @if (session('status') == 'verification-link-sent')
            <div class="alert-success">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Tautan verifikasi baru telah dikirimkan ke email Anda.
            </div>
        @endif

        <div class="actions">
            <!-- Kirim ulang verifikasi -->
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn-primary">
                    Kirim Ulang Email Verifikasi
                </button>
            </form>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">
                    Keluar dari Akun
                </button>
            </form>
        </div>

        <div class="divider"><span>Sistem Informasi Sekolah</span></div>
        <div class="card-footer">
            &copy; {{ date('Y') }} &nbsp;<strong>MUH_BJN</strong> &nbsp;— Hak cipta dilindungi
        </div>
    </div>
</body>

</html>