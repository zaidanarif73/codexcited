<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 404 - CODEXCITED</title>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <style>
        /* Reset & base */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family:  'Jost', sans-serif;
            background: linear-gradient(to bottom, #0699cc, #06bbcc, #066acc);
            color: #fff;
            overflow-x: hidden;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
        }

        /* Clouds */
        .cloud {
            position: absolute;
            background: #fff;
            border-radius: 100px;
            opacity: 0.8;
        }
        .cloud:before, .cloud:after {
            content: '';
            position: absolute;
            background: #fff;
            border-radius: 100px;
        }
        .cloud:before { width: 120px; height: 120px; top: -60px; left: 50px; }
        .cloud:after { width: 60px; height: 60px; top: -30px; right: 30px; }

        .x1 { width: 200px; height: 70px; top: 50px; left: -250px; animation: moveclouds 25s linear infinite; }
        .x2 { width: 250px; height: 90px; top: 120px; left: -300px; animation: moveclouds 30s linear infinite; }
        .x3 { width: 180px; height: 60px; top: 200px; left: -200px; animation: moveclouds 35s linear infinite; }

        @keyframes moveclouds {
            0% { transform: translateX(0); }
            100% { transform: translateX(120vw); }
        }

        /* Error Text */
        .error-code {
            font-size: 220px;
            letter-spacing: 15px;
            font-weight: 700;
        }
        .error-msg {
            font-size: 2rem;
            margin-top: 10px;
        }
        .error-submsg {
            font-size: 1rem;
            margin-bottom: 30px;
        }

        /* Button */
        .btn-back {
            background: #fff;
            color: #000;
            padding: 12px 30px;
            font-size: 18px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-back:hover {
            background: #f0f0f0;
        }

        /* Responsive */
        @media (max-width: 768px){
            .error-code { font-size: 120px; letter-spacing: 8px; }
            .error-msg { font-size: 1.5rem; }
            .error-submsg { font-size: 0.9rem; }
            .btn-back { font-size: 16px; padding: 10px 25px; }
        }
    </style>
</head>
<body>
    <!-- Clouds -->
    <div class="cloud x1"></div>
    <div class="cloud x2"></div>
    <div class="cloud x3"></div>

    <!-- Error Content -->
    <div class="content">
        <div class="error-code">404</div>
        <div class="error-msg">Page Not Found</div>
        <div class="error-submsg">Maaf, halaman yang kamu cari tidak tersedia.</div>
        <a href="/" class="btn-back">Kembali ke Home</a>
    </div>
</body>
</html>