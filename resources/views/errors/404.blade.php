<html lang="en">
    <head>
        <base href="./">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('site.webmanifest') }}">
        <title>{{ config('app.webname') }} | Page Not Found</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com" rel="preconnect">
        <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="{{ asset("asset_front/vendor/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet">
        <link href="{{ asset("asset_front/vendor/bootstrap-icons/bootstrap-icons.css") }}" rel="stylesheet">
        <link href="{{ asset("asset_front/vendor/aos/aos.css") }}" rel="stylesheet">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
        <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>

        <!-- Main CSS File -->
        <link href="{{ asset("asset_front/css/main.css") }}" rel="stylesheet">

        <style>
            .error-code {
                font-size: 120px;
                font-weight: 900;
                color: #ff6f61;
            }
        </style>

    </head>
    <body>

        <div class="container">
            <div class="d-flex flex-column justify-content-center align-items-center vh-100">
                <img src="{{ asset('static/notfound.png') }}" class="img-fluid" />
                <h1 class="error-code mb-3">404 :(</h1>
                <div class="fw-normal">Wah maaf nih sepertinya halaman yang kamu cari gak bisa ditemukan</div>
                <a class="h5 fw-normal mt-3 btn btn-outline-secondary" href="{{ url('/admin') }}"><i class="bi bi-house"></i> Kembali ke Beranda</a>
            </div>
        </div>

    </body>
</html>
