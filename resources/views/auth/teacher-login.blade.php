<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #5c6bc0, #3f51b5); /* Soft blue gradient */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 20px;
        }

        /* Login Form Container */
        .login-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-left: 35%;
            width: 100%;
            max-width: 400px;
            
            animation: fadeIn 0.5s ease-in-out; /* Smooth fade-in animation */
        }

        /* Header */
        .login-header {
            text-align:center;
            margin-bottom: 1.5rem;
            color: #2c3e50; /* Dark gray for the header */
        }

        .login-header h2 {
            font-weight: bold;
            font-size: 26px;
        }

        /* Input Fields */
        .form-control {
            border-radius: 8px;
            padding: 12px;
            font-size: 16px;
            transition: all 0.3s ease-in-out;
            border: 1px solid #bdc3c7; /* Light gray border */
        }

        /* Input Focus Effect */
        .form-control:focus {
            border-color: #3f51b5;
            box-shadow: 0 0 8px rgba(63, 81, 181, 0.5); /* Soft blue glow on focus */
        }

        /* Submit Button */
        .btn-primary {
            background: linear-gradient(to right, #3f51b5, #2c3e50); /* Blue to dark gray gradient */
            border: none;
            padding: 12px;
            font-size: 18px;
            border-radius: 8px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        /* Button Hover Effect */
        .btn-primary:hover {
            background: linear-gradient(to right, #2c3e50, #1a2d44); /* Darker gradient on hover */
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Remember Me Checkbox */
        .form-check {
            text-align: left;
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

        /* Mobile Responsive */
        @media (max-width: 480px) {
            .login-container {
                padding: 1.5rem;
                margin-left: 5px;
            }
            .login-header h2 {
                font-size: 24px;
            }
        }


    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="login-header">
                <h2>Teacher Login</h2>
            </div>
            <form method="POST" action="{{ route('teacher.login') }}">
                @csrf
                <div class="mb-3">
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

                <div class="mb-3">
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

                <div class="mb-3 form-check">
                    <input
                        type="checkbox"
                        class="form-check-input"
                        id="remember"
                        name="remember"
                    >
                    <label class="form-check-label" for="remember">
                        Remember me
                    </label>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">
                        Login
                    </button>
                </div>

                {{-- <div class="text-center mt-3">
                    <a href="{{ route('password.request') }}" class="text-muted">
                        Forgot your password?
                    </a>
                </div> --}}
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
