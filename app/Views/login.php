<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login - Wisata Bondowoso</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #e0f2ff, #f9faff);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            inset: 0;
            background: inherit;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            z-index: 0;
        }

        .login-wrapper {
            z-index: 1;
            position: relative;
            max-width: 1000px;
            width: 100%;
            background: #ffffffcc;
            /* putih transparan */
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: row;
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }

        .login-image {
            flex: 1;
            background-image: url('/assets/images/background-login.jpg');
            background-size: cover;
            background-position: center;
            min-height: 500px;
        }

        .login-form {
            flex: 1;
            padding: 60px 40px;
        }

        .login-form h2 {
            color: #1e40af;
            margin-bottom: 10px;
            font-weight: 600;
            font-size: 2rem;
        }

        .login-form p.subtext {
            color: #6b7280;
            margin-bottom: 30px;
            font-size: 0.95rem;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px;
        }

        .btn-login {
            background-color: #1e40af;
            color: white;
            font-weight: 600;
            border-radius: 12px;
            padding: 12px 20px;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background-color: #1e3a8a;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(30, 64, 175, 0.3);
        }

        .error-text {
            color: red;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .login-wrapper {
                flex-direction: column;
            }

            .login-image {
                height: 220px;
                min-height: unset;
            }

            .login-form {
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>

    <div class="login-wrapper">
        <div class="login-form">
            <h2>Login Untuk Akes Sistem</h2>
            <p class="subtext">Masuk ke akun Anda untuk mulai menjelajahi keindahan wisata Bondowoso.</p>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="error-text"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form action="/login" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-login w-100">Masuk</button>
            </form>
        </div>

        <div class="login-image"></div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>