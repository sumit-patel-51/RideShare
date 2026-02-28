<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Rideshare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff; /* Pure white background */
            font-family: 'Inter', sans-serif;
            color: #000000;
        }

        .login-card {
            border: 2px solid #000000; /* Bold black border */
            border-radius: 24px;
            box-shadow: 8px 8px 0px 0px rgba(0,0,0,1); /* Professional "Crisp" shadow */
            background: #ffffff;
            max-width: 400px;
            margin: auto;
        }

        .form-label {
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 1px;
        }

        .form-control {
            border: 1px solid #000000;
            border-radius: 12px;
            padding: 12px;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #FF9F43; /* Light Orange focus */
        }

        .btn-login {
            background-color: #FF9F43; /* Your Light Orange */
            color: #000000;
            border: 2px solid #000000;
            border-radius: 12px;
            padding: 14px;
            font-weight: 900;
            text-transform: uppercase;
            transition: transform 0.1s ease;
        }

        .btn-login:hover {
            background-color: #ff8e1d;
            transform: translate(-2px, -2px);
            box-shadow: 4px 4px 0px 0px rgba(0,0,0,1);
        }

        .brand-logo {
            font-weight: 900;
            font-size: 2rem;
            color: #000000;
            margin-bottom: 2rem;
        }

        .orange-dot {
            color: #FF9F43;
        }
    </style>
</head>

<body class="d-flex align-items-center vh-100">

    <div class="container">
        <div class="text-center brand-logo">
            RIDE<span class="orange-dot">.</span>SHARE
        </div>

        <div class="card login-card p-4">
            <h3 class="fw-black mb-4">Welcome Back</h3>

            <form method="POST" action="/login">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="name@example.com">
                </div>

                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••">
                </div>

                <button type="submit" class="btn btn-login w-100 mb-3">Login Now</button>
            </form>

            @if ($errors->any())
                <div class="alert alert-dark border-2 border-black rounded-4 mt-3">
                    <ul class="mb-0 small fw-bold">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="text-center mt-3">
                <small class="fw-bold">Don't have an account? <a href="{{ route('register') }}" class="text-dark">Sign Up</a></small>
            </div>
        </div>
    </div>

</body>
</html>