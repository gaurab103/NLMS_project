<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NLMS Admin Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2a1b4e;
            --secondary-color: #3d2b6e;
            --accent-color: #ffd700;
            --gradient-bg: linear-gradient(135deg, #1a102e 0%, #2a1b4e 100%);
        }

        body {
            background: var(--gradient-bg);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            padding: 2.5rem;
            width: 100%;
            max-width: 450px;
            transform: translateY(0);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
            position: relative;
        }

        .brand-logo {
            width: 120px;
            margin-bottom: 1.5rem;
            filter: drop-shadow(0 2px 4px rgba(42, 27, 78, 0.2));
        }

        h2 {
            color: var(--primary-color);
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border-radius: 8px;
            padding: 0.75rem 1.25rem;
            border: 2px solid #e0e0e0;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(42, 27, 78, 0.1);
        }

        .input-group-text {
            background: white;
            border: 2px solid #e0e0e0;
            border-right: none;
            padding: 0 1rem;
        }

        .btn-admin {
            background: var(--primary-color);
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-admin:hover {
            background: var(--secondary-color);
            transform: translateY(-1px);
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .forgot-password {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: var(--secondary-color);
        }

        @media (max-width: 576px) {
            .login-container {
                margin: 1rem;
                padding: 1.5rem;
            }

            .brand-logo {
                width: 100px;
            }
        }

        /* Security Badge */
        .security-notice {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.9rem;
            color: #666;
        }

        .security-icon {
            color: var(--primary-color);
            font-size: 1.2rem;
            margin-right: 0.5rem;
        }

        /* Fade-in Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-container {
            animation: fadeIn 0.5s ease-out;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <img src="{{ asset('images/logo/logo.png') }}" alt="NLMS Logo" class="brand-logo">
            <h2>Admin Login</h2>
            <p class="text-muted">System Management Access</p>
        </div>
        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="mb-4">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-user-shield text-secondary"></i>
                    </span>
                    <input
                        id="username"
                        type="text"
                        class="form-control @error('username') is-invalid @enderror"
                        name="username"
                        value="{{ old('username') }}"
                        required
                        autofocus
                        placeholder="Admin ID"
                    >
                </div>
                @error('username')
                    <div class="invalid-feedback d-block">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-lock text-secondary"></i>
                    </span>
                    <input
                        id="password"
                        type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        name="password"
                        required
                        placeholder="Security Key"
                    >
                </div>
                @error('password')
                    <div class="invalid-feedback d-block">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                    </div>
                @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input
                        type="checkbox"
                        class="form-check-input"
                        id="remember"
                        name="remember"
                    >

            <div class="d-grid mb-4">
                <button type="submit" class="btn btn-admin btn-lg text-white">
                    <i class="fas fa-unlock-alt me-2"></i>Login
                </button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
