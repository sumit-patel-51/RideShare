<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | RideShare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff;
            font-family: 'Inter', sans-serif;
            color: #000000;
            overflow-x: hidden;
        }

        /* --- Navbar Upgrade --- */
        .navbar {
            background-color: #ffffff !important;
            border-bottom: 2px solid #000000;
            padding: 15px 0;
        }

        .navbar-brand {
            font-weight: 900;
            color: #000000 !important;
            letter-spacing: -1px;
        }

        .orange-dot {
            color: #FF9F43;
        }

        /* --- Sidebar Upgrade --- */
        .sidebar {
            min-height: 100vh;
            background-color: #ffffff;
            border-right: 2px solid #000000;
            padding-top: 2rem;
        }

        .nav-link {
            font-weight: 700;
            color: #000000 !important;
            padding: 12px 20px;
            border-radius: 12px;
            margin-bottom: 5px;
            transition: all 0.2s;
            border: 1px solid transparent;
        }

        .nav-link:hover {
            background-color: #FF9F43;
            border: 1px solid #000000;
        }

        .nav-link.active {
            background-color: #FF9F43;
            border: 1px solid #000000;
            box-shadow: 4px 4px 0px 0px rgba(0, 0, 0, 1);
        }

        .nav-link.active,
        .nav-link:hover {
            background-color: #FF9F43 !important;
            border: 2px solid #000000 !important;
            box-shadow: 4px 4px 0px 0px rgba(0, 0, 0, 1);
            color: #000000 !important;
        }

        /* --- Custom Professional Buttons --- */
        .btn-post {
            background-color: #FF9F43;
            color: #000000;
            border: 2px solid #000000;
            font-weight: 900;
            border-radius: 10px;
            padding: 8px 20px;
            transition: 0.2s;
        }

        .btn-post:hover {
            background-color: #ff8e1d;
            box-shadow: 3px 3px 0px 0px rgba(0, 0, 0, 1);
            transform: translate(-2px, -2px);
        }

        .btn-logout {
            border: 2px solid #000000;
            background: #ffffff;
            font-weight: 700;
            border-radius: 10px;
        }

        /* --- Mobile Overlay/Sidebar --- */
        @media (max-width: 991px) {
            .sidebar {
                position: fixed;
                left: -280px;
                width: 280px;
                z-index: 1050;
                transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: 10px 0px 0px 0px rgba(0, 0, 0, 1);
            }

            .sidebar.active {
                left: 0;
            }
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 159, 67, 0.2);
            /* Tinted orange overlay */
            backdrop-filter: blur(4px);
            z-index: 1040;
        }

        .overlay.active {
            display: block;
        }

        .profile-img {
            border: 2px solid #000000;
            padding: 3px;
            background: #FF9F43;
        }
    </style>
</head>

<body>

    <div class="overlay" id="overlay" onclick="closeSidebar()"></div>

    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid px-4">
            <button class="btn d-lg-none me-2 border-2 border-dark" onclick="toggleSidebar()">
                <span class="fw-bold">☰</span>
            </button>

            <a class="navbar-brand fs-3" href="#">RIDE<span class="orange-dot">.</span>SHARE</a>

            <div class="ms-auto">
                <a href="/rides/create" class="btn btn-post text-uppercase small">Post Ride</a>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-xl-2 sidebar" id="sidebar">
                <div class="text-center mb-5">
                    <img src="https://api.dicebear.com/9.x/notionists/svg?seed={{ auth()->user()->name }}"
                        class="rounded-circle mb-3 profile-img" width="80" height="80">
                    <h6 class="fw-black mb-0">{{ auth()->user()->name }}</h6>
                    <small class="text-muted fw-bold" style="font-size: 10px; text-transform: uppercase;">Verified
                        Member</small>
                </div>

                <ul class="nav flex-column px-2">
                    <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                        <a href="/dashboard" class="nav-link active">Dashboard</a>
                    </li>
                    <li class="nav-item {{ Request::is('rides/my*') ? 'active' : '' }}">
                        <a href="{{ route('rides.my') }}" class="nav-link">My Rides</a>
                    </li>
                    <li class="nav-item {{ Request::is('rides/bookings*') ? 'active' : '' }}">
                        <a href="{{ route('rides.bookings') }}" class="nav-link">My Bookings</a>
                    </li>
                </ul>

                <div class="px-3 mt-5">
                    <hr class="border-2 border-dark opacity-100">
                    <form method="POST" action="/logout">
                        @csrf
                        <button class="btn btn-logout w-100 text-uppercase py-2 small">Logout</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-9 col-xl-10 p-4 bg-light bg-opacity-10">
                <div class="py-2">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('overlay').classList.toggle('active');
        }
        function closeSidebar() {
            document.getElementById('sidebar').classList.remove('active');
            document.getElementById('overlay').classList.remove('active');
        }
    </script>
</body>

</html>