<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RideShare | Travel Together</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            color: #000000;
        }

        /* --- Custom Navbar --- */
        .navbar {
            background-color: #ffffff !important;
            border-bottom: 2px solid #000000;
            padding: 20px 0;
        }

        .navbar-brand {
            font-weight: 900;
            font-size: 1.5rem;
            color: #000000 !important;
            letter-spacing: -1px;
        }

        .orange-dot {
            color: #FF9F43;
        }

        .nav-link {
            color: #000000 !important;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.85rem;
            margin: 0 10px;
        }

        /* --- Hero Section --- */
        .hero-section {
            padding: 100px 0;
            background: radial-gradient(circle at top right, rgba(255, 159, 67, 0.1), transparent);
        }

        .hero-title {
            font-weight: 900;
            font-size: 4rem;
            line-height: 1.1;
            margin-bottom: 25px;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: #444;
            margin-bottom: 40px;
            max-width: 500px;
        }

        /* --- Professional Buttons --- */
        .btn-main {
            background-color: #FF9F43;
            color: #000000;
            border: 2px solid #000000;
            border-radius: 12px;
            padding: 15px 35px;
            font-weight: 900;
            text-transform: uppercase;
            box-shadow: 6px 6px 0px 0px rgba(0, 0, 0, 1);
            transition: all 0.2s ease;
        }

        .btn-main:hover {
            transform: translate(-2px, -2px);
            box-shadow: 8px 8px 0px 0px rgba(0, 0, 0, 1);
            background-color: #ff8e1d;
        }

        .btn-outline-custom {
            border: 2px solid #000000;
            border-radius: 12px;
            padding: 15px 35px;
            font-weight: 900;
            text-transform: uppercase;
            color: #000;
            background: transparent;
        }

        /* --- Feature Cards --- */
        .feature-card {
            border: 2px solid #000;
            border-radius: 20px;
            padding: 30px;
            height: 100%;
            transition: 0.3s;
        }

        .feature-card:hover {
            background-color: #FF9F43;
        }

        /* --- Alerts --- */
        .alert-custom {
            border: 2px solid #000;
            border-radius: 12px;
            font-weight: 700;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/">RIDE<span class="orange-dot">.</span>SHARE</a>

            <button class="navbar-toggler border-2 border-dark" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                    <li class="nav-item">
                        <a class="btn btn-main py-2 px-4 ms-lg-3" href="/register"
                            style="box-shadow: 4px 4px 0px 0px #000;">Join Now</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-section">
        <div class="container">
            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="alert alert-success alert-custom mb-5">{{ session('success') }}</div>
            @endif

            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="hero-title">Your Next <span style="color: #FF9F43;">Ride</span>, Simplified.</h1>
                    <p class="hero-subtitle">
                        Connect with drivers heading your way. Save money, meet new people, and travel sustainably.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="/dashboard" class="btn btn-main">Find a Ride</a>
                        <a href="/rides/create" class="btn btn-outline-custom">Share Your Car</a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block text-center">
                    <div
                        style="width: 100%; height: 400px; border: 4px solid #000; border-radius: 40px; background: #FF9F43; display: flex; align-items: center; justify-content: center; box-shadow: 20px 20px 0px 0px rgba(0,0,0,0.05);">
                        <span style="font-size: 150px;">🚗</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="py-5 bg-light">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card bg-white">
                        <h4 class="fw-black mb-3">01. Safe</h4>
                        <p class="mb-0">Verified drivers and real-time tracking for every journey you take.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card bg-white">
                        <h4 class="fw-black mb-3">02. Cheap</h4>
                        <p class="mb-0">Split the cost of fuel and maintenance by sharing seats with others.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card bg-white">
                        <h4 class="fw-black mb-3">03. Easy</h4>
                        <p class="mb-0">Post or find a ride in less than 60 seconds with our streamlined app.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <main class="container my-5">
        @yield('content')
    </main>

    <footer class="py-5 border-top border-2 border-dark mt-5 text-center">
        <p class="fw-bold mb-0">© 2026 RIDE.SHARE - Built for the road.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>