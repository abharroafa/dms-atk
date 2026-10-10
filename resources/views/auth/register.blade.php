<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - ArsipNota</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --brown: #A98B76;
            --text: #493D34;
            --muted: #817367;
            --border: #E9DED2;
        }

        * { box-sizing: border-box; }

        body {
            min-height: 100vh;
            min-height: 100dvh;
            margin: 0;
            padding: 20px 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #F8F5F0;
            color: var(--text);
            font-family: Arial, Helvetica, sans-serif;
        }

        .auth-card {
            width: 100%;
            max-width: 390px;
            padding: 28px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 8px 28px rgba(73, 61, 52, .07);
        }

        .brand-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 13px;
            background: var(--brown);
            color: white;
            font-size: 25px;
            font-weight: bold;
        }

        .brand-name {
            margin: 0;
            text-align: center;
            font-size: 25px;
            font-weight: 700;
        }

        .brand-description {
            margin: 6px 0 25px;
            color: var(--muted);
            text-align: center;
            font-size: 13px;
            line-height: 1.5;
        }

        .section-title {
            margin-bottom: 6px;
            font-size: 19px;
            font-weight: 700;
        }

        .section-description {
            margin-bottom: 22px;
            color: var(--muted);
            font-size: 13px;
        }

        .form-label {
            margin-bottom: 7px;
            font-size: 13px;
            font-weight: 600;
        }

        .form-control {
            min-width: 0;
            height: 44px;
            border-color: #DED5CB;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: var(--brown);
            box-shadow: 0 0 0 3px rgba(169, 139, 118, .16);
        }

        .input-group-text {
            width: 43px;
            justify-content: center;
            background: #FAF7F3;
            color: var(--brown);
            border-color: #DED5CB;
        }

        .toggle-password {
            width: 43px;
            flex-shrink: 0;
            border: 1px solid #DED5CB;
            border-left: 0;
            border-radius: 0 8px 8px 0;
            background: white;
            color: var(--muted);
        }

        .toggle-password:hover {
            color: var(--brown);
            background: #FAF7F3;
        }

        .btn-auth {
            min-height: 44px;
            background: var(--brown);
            border: 1px solid var(--brown);
            border-radius: 8px;
            color: white;
            font-size: 14px;
            font-weight: 600;
        }

        .btn-auth:hover {
            background: #92745F;
            color: white;
        }

        .auth-link-text {
            margin: 18px 0 0;
            color: var(--muted);
            font-size: 12px;
            text-align: center;
        }

        .auth-link {
            color: var(--brown);
            font-weight: 700;
            text-decoration: none;
        }

        .auth-link:hover {
            color: #92745F;
            text-decoration: underline;
        }

        .footer-text {
            margin: 22px 0 0;
            color: var(--muted);
            font-size: 11px;
            line-height: 1.7;
            text-align: center;
        }

        .alert { font-size: 13px; }

        @media (max-width: 480px) {
            .auth-card { padding: 24px 20px; }
            .brand-name { font-size: 23px; }
        }
    </style>
</head>
<body>
<main class="auth-card">
    <header>
        <div class="brand-icon">A</div>
        <h1 class="brand-name">ArsipNota</h1>
        <p class="brand-description">
            Sistem Pengelolaan Dokumen Toko ATK
        </p>
    </header>

    <section>
        <h2 class="section-title">Buat akun baru</h2>
        <p class="section-description">
            Daftar untuk menggunakan ArsipNota.
        </p>

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('register.process') }}">
            @csrf

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-person"></i>
                    </span>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        class="form-control"
                        placeholder="Buat username"
                        value="{{ old('username') }}"
                        autocomplete="username"
                        minlength="3"
                        maxlength="50"
                        required
                        autofocus
                    >
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-lock"></i>
                    </span>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        style="border-radius: 0;"
                        placeholder="Minimal 8 karakter"
                        autocomplete="new-password"
                        minlength="8"
                        required
                    >
                    <button
                        type="button"
                        class="toggle-password"
                        data-target="password"
                        aria-label="Tampilkan password"
                        aria-pressed="false"
                    >
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="form-label">
                    Konfirmasi password
                </label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-shield-lock"></i>
                    </span>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="form-control"
                        style="border-radius: 0;"
                        placeholder="Ulangi password"
                        autocomplete="new-password"
                        minlength="8"
                        required
                    >
                    <button
                        type="button"
                        class="toggle-password"
                        data-target="password_confirmation"
                        aria-label="Tampilkan konfirmasi password"
                        aria-pressed="false"
                    >
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn btn-auth w-100">
                <i class="bi bi-person-plus me-2"></i>
                Daftar
            </button>
        </form>

        <p class="auth-link-text">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="auth-link">Masuk</a>
        </p>
    </section>

    <footer class="footer-text">
        ArsipNota &copy; {{ date('Y') }}<br>
        Sistem Arsip Digital Toko ATK
    </footer>
</main>

<script>
document.querySelectorAll('.toggle-password').forEach(function (button) {
    button.addEventListener('click', function () {
        const input = document.getElementById(button.dataset.target);
        const icon = button.querySelector('i');
        const show = input.type === 'password';

        input.type = show ? 'text' : 'password';
        icon.classList.toggle('bi-eye', !show);
        icon.classList.toggle('bi-eye-slash', show);

        button.setAttribute(
            'aria-label',
            show ? 'Sembunyikan password' : 'Tampilkan password'
        );
        button.setAttribute('aria-pressed', String(show));
    });
});
</script>
</body>
</html>