<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | RideShare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff;
            font-family: 'Inter', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        .auth-card {
            border: 3px solid #000000;
            border-radius: 24px;
            background: #ffffff;
            box-shadow: 10px 10px 0px 0px rgba(0, 0, 0, 1);
            width: 100%;
            max-width: 450px;
            padding: 40px;
        }

        .brand-logo {
            font-weight: 900;
            letter-spacing: -1px;
            font-size: 1.5rem;
            text-align: center;
            margin-bottom: 30px;
        }

        .orange-dot {
            color: #FF9F43;
        }

        .form-label {
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }

        .form-control {
            border: 2px solid #000000;
            border-radius: 12px;
            padding: 12px;
        }

        .form-control:focus {
            border-color: #FF9F43;
            box-shadow: none;
            outline: none;
        }

        .btn-send {
            background-color: #FF9F43;
            color: #000000;
            border: 2px solid #000000;
            font-weight: 900;
            border-radius: 12px;
            padding: 15px;
            text-transform: uppercase;
            transition: 0.2s;
        }

        .btn-send:hover {
            background-color: #ff8e1d;
            box-shadow: 4px 4px 0px 0px rgba(0, 0, 0, 1);
            transform: translate(-2px, -2px);
        }

        .success-banner {
            background-color: #d1e7dd;
            border: 2px solid #0f5132;
            color: #0f5132;
            padding: 10px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.85rem;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center px-3">
        <div class="auth-card">
            <div class="brand-logo">
                RIDE<span class="orange-dot">.</span>SHARE
            </div>

            <h4 class="fw-black mb-2 text-center">Forgot Password?</h4>
            <p class="text-muted small text-center mb-4 fw-bold">No worries! Enter your email and we'll send you a reset
                link.</p>

            @if (session('status'))
                <div class="success-banner">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-4">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="your@email.com" required
                        autofocus>
                    @error('email')
                        <small class="text-danger fw-bold mt-1 d-block">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-send w-100">
                    Send Reset Link
                </button>
            </form>

            <div class="text-center mt-4">
                <a href="/login" class="text-decoration-none text-dark small fw-bold">← Back to Login</a>
            </div>
        </div>
    </div>
</body>

</html>