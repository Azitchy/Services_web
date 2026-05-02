<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Smart Express Cleaning</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url('/images/login-bg.png') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow: hidden;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
            color: #ffffff;
            text-align: center;
        }

        .login-card h1 {
            font-weight: 600;
            font-size: 2.5rem;
            margin-bottom: 30px;
            letter-spacing: 1px;
        }

        .form-group {
            position: relative;
            margin-bottom: 20px;
        }

        .form-group i {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1rem;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.1) !important;
            border: 1px solid rgba(255, 255, 255, 0.3) !important;
            border-radius: 50px !important;
            padding: 12px 25px !important;
            color: #ffffff !important;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.15) !important;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.5) !important;
        }

        .form-check {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
            font-size: 0.9rem;
            padding-left: 0;
        }

        .form-check-input {
            margin-right: 8px;
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            cursor: pointer;
        }

        .form-check-label {
            cursor: pointer;
        }

        .forgot-password {
            color: #ffffff;
            text-decoration: none;
            transition: opacity 0.3s;
        }

        .forgot-password:hover {
            opacity: 0.8;
            color: #ffffff;
        }

        .btn-login {
            background: #ffffff;
            color: #333;
            border: none;
            border-radius: 50px;
            padding: 12px;
            width: 100%;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .btn-login:hover {
            background: rgba(255, 255, 255, 0.9);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .register-link {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.8);
        }

        .register-link a {
            color: #ffffff;
            text-decoration: none;
            font-weight: 600;
        }

        .alert {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #ffffff;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            font-size: 0.9rem;
        }

        /* Responsive adjustments */
        @media (max-width: 480px) {
            .login-card {
                padding: 30px 20px;
                max-width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h1>Login</h1>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0 text-start">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Username" value="{{ old('email') }}" required autofocus>
                <i class="bi bi-person-fill"></i>
            </div>

            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <i class="bi bi-lock-fill"></i>
            </div>

            <div class="form-check">
                <div>
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">Remember me</label>          

            <button type="submit" class="btn-login" style="
    margin: 34px;
">Login</button>
          
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

