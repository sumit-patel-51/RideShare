<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Access Denied | RideShare</title>
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
        .forbidden-icon {
            font-size: 6rem;
            margin-bottom: 10px;
            display: block;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        .error-card {
            border: 4px solid #000;
            border-radius: 30px;
            background: #ffffff;
            box-shadow: 15px 15px 0px 0px #000;
            padding: 50px 40px;
            max-width: 550px;
            position: relative;
        }
        /* Top "Security Bar" */
        .security-header {
            background: #ff4343; /* Bright Red */
            color: #fff;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            padding: 8px;
            font-weight: 900;
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 2px;
            border-bottom: 4px solid #000;
            border-radius: 25px 25px 0 0;
        }
        .error-title {
            font-weight: 900;
            font-size: 3.5rem;
            color: #000;
            margin-top: 15px;
            line-height: 1;
        }
        .btn-return {
            background-color: #FF9F43;
            color: #000;
            border: 3px solid #000;
            font-weight: 900;
            border-radius: 14px;
            padding: 16px 32px;
            text-transform: uppercase;
            text-decoration: none;
            display: inline-block;
            transition: 0.2s;
            box-shadow: 6px 6px 0px 0px #000;
            margin-top: 20px;
        }
        .btn-return:hover {
            transform: translate(-3px, -3px);
            box-shadow: 9px 9px 0px 0px #000;
            color: #000;
        }
        .restriction-notice {
            background: #f8f9fa;
            border: 2px dashed #000;
            padding: 15px;
            border-radius: 12px;
            font-weight: 700;
            color: #ff4343;
            margin: 25px 0;
        }
    </style>
</head>
<body>

    <div class="error-container">
        <div class="error-card">
            <div class="security-header">Security Clearance Required</div>
            
            <span class="forbidden-icon">🚫</span>
            
            <h1 class="error-title">403</h1>
            <h3 class="fw-black text-uppercase mt-2">Access Denied</h3>
            
            <div class="restriction-notice">
                Unauthorized access. <br>
                Admin privileges are required to view this area.
            </div>
            
            <p class="text-muted fw-bold mb-4">
                Your account does not have the necessary permissions to enter this sector.
            </p>
            
            <a href="/dashboard" class="btn-return">
                Back to Safety
            </a>
        </div>

        <p class="mt-5 text-muted small fw-black text-uppercase" style="letter-spacing: 2px;">
            Shielded by <span style="color: #FF9F43;">RideShare</span> Security v2.0
        </p>
    </div>

</body>
</html>