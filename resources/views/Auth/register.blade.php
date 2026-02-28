<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join | Rideshare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff;
            font-family: 'Inter', sans-serif;
            color: #000000;
            -webkit-font-smoothing: antialiased;
        }

        .register-card {
            border: 2px solid #000000;
            border-radius: 24px;
            box-shadow: 8px 8px 0px 0px rgba(0, 0, 0, 1);
            background: #ffffff;
            max-width: 450px;
            /* Slightly wider for form fields */
            margin: 2rem auto;
        }

        .form-label {
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .form-control {
            border: 1px solid #000000;
            border-radius: 12px;
            padding: 10px 15px;
            font-size: 0.95rem;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #FF9F43;
        }

        .btn-register {
            background-color: #FF9F43;
            color: #000000;
            border: 2px solid #000000;
            border-radius: 12px;
            padding: 14px;
            font-weight: 900;
            text-transform: uppercase;
            transition: all 0.2s ease;
        }

        .btn-register:hover {
            background-color: #ff8e1d;
            transform: translate(-2px, -2px);
            box-shadow: 4px 4px 0px 0px rgba(0, 0, 0, 1);
        }

        .brand-logo {
            font-weight: 900;
            font-size: 1.8rem;
            color: #000000;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .orange-dot {
            color: #FF9F43;
        }

        /* Custom Alert Styling */
        .alert-custom {
            background-color: #ffffff;
            border: 2px solid #000000;
            border-radius: 12px;
            color: #000000;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="text-center brand-logo">
            RIDE<span class="orange-dot">.</span>SHARE
        </div>

        <div class="card register-card p-4 p-md-5">
            <h3 class="fw-black mb-4">Create Account</h3>

            <form method="POST" action="/register">
                @csrf

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="text" name="phone" class="form-control" placeholder="+1 234 567 890">
                </div>

                <div class="mb-4">
                    <label class="form-label">Create Password</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn btn-register w-100 mb-3">Get Started</button>
            </form>

            @if ($errors->any())
                <div class="alert alert-custom mt-3">
                    <ul class="mb-0 small fw-bold">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="text-center mt-3">
                <small class="fw-bold">Already a member? <a href="/login" class="text-dark">Login</a></small>
            </div>
        </div>
    </div>

</body>

</html>