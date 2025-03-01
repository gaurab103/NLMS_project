<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NLMS Teacher Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4e3e7b;
            --accent-color: #ffd700;
            --gradient-bg: linear-gradient(135deg, #4e3e7b 0%, #2a1b4e 100%);
        }

        body {
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 2rem;
            width: 100%;
            max-width: 450px;
        }
        .login-header {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #343a40;
        }

        .login-header h2 {
            font-weight: bold;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <img src="{{ asset('images/logo/logo.png') }}" alt="NLMS Logo" class="brand-logo">
            <h2>Teacher Portal Login</h2>
        </div>
        <form method="POST" action="{{ route('teacher.login') }}">
            @csrf
            <div class="mb-4">
                <label for="username" class="form-label">Username</label>
                <input
                    id="username"
                    type="text"
                    class="form-control @error('username') is-invalid @enderror"
                    name="username"
                    value="{{ old('username') }}"
                    required
                    autofocus
                    placeholder="Enter your username"
                >
                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input
                    id="password"
                    type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password"
                    required
                    placeholder="Enter your password"
                >
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-4 form-check">
                <input
                    type="checkbox"
                    class="form-check-input"
                    id="remember"
                    name="remember"
                >
                <label class="form-check-label" for="remember">
                    Remember credentials
                </label>
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-teacher btn-lg">
                    Login
                </button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
