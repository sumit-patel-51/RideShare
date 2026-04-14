<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Ride Not Found | RideShare</title>
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
            overflow: hidden;
        }
        .error-container {
            text-align: center;
            padding: 20px;
        }
        .error-code {
            font-size: clamp(8rem, 20vw, 12rem);
            font-weight: 900;
            line-height: 0.8;
            margin-bottom: 20px;
            position: relative;
            display: inline-block;
            color: #000;
            -webkit-text-stroke: 2px #000;
        }
        .error-code::after {
            content: "404";
            position: absolute;
            left: 10px;
            top: 10px;
            color: #FF9F43;
            z-index: -1;
        }
        .error-card {
            border: 3px solid #000;
            border-radius: 24px;
            background: #ffffff;
            box-shadow: 12px 12px 0px 0px #000;
            padding: 40px;
            max-width: 500px;
            margin-top: -20px;
        }
        .btn-home {
            background-color: #FF9F43;
            color: #000;
            border: 3px solid #000;
            font-weight: 900;
            border-radius: 12px;
            padding: 15px 30px;
            text-transform: uppercase;
            text-decoration: none;
            display: inline-block;
            transition: 0.2s;
            box-shadow: 6px 6px 0px 0px #000;
        }
        .btn-home:hover {
            transform: translate(-3px, -3px);
            box-shadow: 9px 9px 0px 0px #000;
            color: #000;
        }
    </style>
</head>
<body>

    <div class="error-container">
        <div class="error-code">404</div>

        <div class="error-card mx-auto">
            <h2 class="fw-black mb-3">WRONG TURN?</h2>
            <p class="text-muted fw-bold mb-4">
                The page you are looking for has taken a detour or never existed. 
                Let's get you back on track.
            </p>
            
            <a href="/dashboard" class="btn-home">
                Back to Dashboard
            </a>
        </div>

        <p class="mt-5 text-muted small fw-black text-uppercase tracking-widest" style="letter-spacing: 2px;">
            Ride<span style="color: #FF9F43;">.</span>Share Security Team
        </p>
    </div>

</body>
</html>