<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ ucfirst($userType ?? 'User') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #e4f1fe;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            width: 400px;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .logo-container {
            text-align: center;
            padding: 20px 0;
        }
        .logo-container img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 10%;
            border: 2px solid black;
        }
        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
        }
        .back-button img {
            width: 40px;
            height: 40px;
            transition: transform 0.3s;
        }
        .back-button img:hover {
            transform: scale(1.1);
        }
        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <a href="{{ route('pannel') }}" class="back-button">
        <img src="/images/pannel/icons8-back-100.png" alt="Back">
    </a>

    <div class="card p-4">
        <div class="logo-container">
            <img src="/images/pannel/logo.png" alt="Logo">
            <h4 class="mt-3">Login as {{ ucfirst($userType ?? 'User') }}</h4>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route($userType . '.login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">{{ $userType === 'admin' ? 'Username' : 'Email' }}</label>
                <input type="{{$userType === 'admin' ? 'text' : 'email'}}"
                       class="form-control @error('email') is-invalid @enderror"
                       name="{{ $userType === 'admin' ? 'username' : 'email' }}"
                       value="{{ old($userType === 'admin' ? 'username' : 'email') }}"
                       required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       name="password"
                       required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</body>
</html>
