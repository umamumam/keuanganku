<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Sistem Keuangan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --success-color: #4cc9f0;
            --danger-color: #f72585;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fb;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            color: var(--dark-color);
        }

        .register-container {
            width: 100%;
            max-width: 420px;
            padding: 1rem;
        }

        @media (min-width: 768px) {
            .register-container {
                max-width: 500px;
                padding: 2rem;
            }

            .register-card {
                padding: 2.5rem;
            }

            .register-header h2 {
                font-size: 2rem;
            }

            .form-control {
                padding: 1rem 1.25rem;
                font-size: 1rem;
            }

            .btn-register {
                padding: 1rem;
                font-size: 1.1rem;
            }
        }

        .register-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: transform 0.3s ease;
            width: 100%;
        }

        .register-card:hover {
            transform: translateY(-5px);
        }

        .register-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 1.5rem;
            text-align: center;
        }

        .register-header h2 {
            margin: 0;
            font-weight: 600;
            font-size: 1.5rem;
        }

        .register-body {
            padding: 1.5rem;
        }

        @media (min-width: 768px) {
            .register-body {
                padding: 2.5rem;
            }
        }

        .form-control {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            border: 1px solid #e0e0e0;
            transition: all 0.3s;
            font-size: 0.9rem;
        }

        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.15);
        }

        .btn-register {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 8px;
            padding: 0.75rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            font-size: 0.95rem;
            color: white;
            width: 100%;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }

        .input-icon {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            font-size: 1rem;
        }

        @media (min-width: 768px) {
            .input-icon i {
                font-size: 1.2rem;
                left: 20px;
            }
        }

        .input-icon input {
            padding-left: 40px;
        }

        @media (min-width: 768px) {
            .input-icon input {
                padding-left: 50px;
            }
        }

        .invalid-feedback {
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }

        .register-footer {
            text-align: center;
            margin-top: 1.5rem;
            color: #6c757d;
            font-size: 0.9rem;
        }

        @media (min-width: 768px) {
            .register-footer {
                font-size: 1rem;
            }
        }

        .register-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .register-footer a:hover {
            text-decoration: underline;
        }

        .password-strength {
            margin-top: 0.5rem;
            font-size: 0.8rem;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <div class="register-card">
            <div class="register-header">
                <h2><i class="bi bi-wallet2"></i> Daftar Akun Baru</h2>
            </div>

            <div class="register-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="input-icon">
                        <i class="bi bi-person"></i>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name"
                            placeholder="Nama Lengkap" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="input-icon">
                        <i class="bi bi-envelope"></i>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email"
                            placeholder="Alamat Email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="input-icon">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-lock me-2"></i>
                            <label for="password" class="form-label mb-0">Kata Sandi</label>
                        </div>
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="new-password" placeholder="Masukkan kata sandi">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="password-strength mt-1">
                            Gunakan minimal 8 karakter dengan kombinasi huruf dan angka
                        </div>
                    </div>

                    <div class="input-icon">
                        <i class="bi bi-lock-fill"></i>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password" placeholder="Konfirmasi Kata Sandi">
                    </div>

                    <button type="submit" class="btn btn-register mb-3">
                        <i class="bi bi-person-plus me-2"></i> Daftar Sekarang
                    </button>

                    <div class="register-footer">
                        Sudah punya akun? <a href="{{ route('login') }}">Masuk disini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
