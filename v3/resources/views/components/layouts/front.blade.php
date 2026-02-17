<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset("asset_front/vendor/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{ asset("asset_front/vendor/bootstrap-icons/bootstrap-icons.css") }}" rel="stylesheet">
    <link href="{{ asset("asset_front/vendor/aos/aos.css") }}" rel="stylesheet">
    <link href="{{ asset("asset_front/vendor/glightbox/css/glightbox.min.css") }}" rel="stylesheet">
    <link href="{{ asset("asset_front/vendor/swiper/swiper-bundle.min.css") }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset("asset_front/css/main.css") }}" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('asset_front/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset_front/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('asset_front/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('asset_front/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset_front/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('asset_front/css/main.css') }}" rel="stylesheet">

    {!! Meta::toHtml() !!}

    @vite('resources/js/app.js')
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

            <a href="{{ url("/") }}" class="logo d-flex align-items-center me-auto me-xl-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1 class="sitename ms-md-5">{{ config('app.webname_short') }}</h1><span>.</span>
            </a>

            <nav id="navmenu" class="navmenu me-md-5">
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/berita') }}">Berita</a></li>
                    <li><a href="{{ url('/galeri') }}">Galeri</a></li>
                    <li><a href="{{ url('/kontak') }}">Kontak</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

        </div>
    </header>

    <main class="main">
        {{ $slot }}
    </main>

    <livewire:partial.footer-front />

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset("asset_front/vendor/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
    <script src="{{ asset("asset_front/vendor/php-email-form/validate.js") }}"></script>
    <script src="{{ asset("asset_front/vendor/aos/aos.js") }}"></script>
    <script src="{{ asset("asset_front/vendor/glightbox/js/glightbox.min.js") }}"></script>
    <script src="{{ asset("asset_front/vendor/purecounter/purecounter_vanilla.js") }}"></script>
    <script src="{{ asset("asset_front/vendor/swiper/swiper-bundle.min.js") }}"></script>
    <script src="{{ asset("asset_front/vendor/imagesloaded/imagesloaded.pkgd.min.js") }}"></script>
    <script src="{{ asset("asset_front/vendor/isotope-layout/isotope.pkgd.min.js") }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset("asset_front/js/main.js") }}"></script>

    <script>
        document.addEventListener('livewire:init', (event) => {

            Livewire.on('notif', (e) => {
                Swal.fire({
                    text: e.message,
                    icon: e.icon
                });
            });

            Livewire.on('close-modal', (e) => {
                const targetModal = document.querySelector(`#${e.namamodal}`);
                const modal = bootstrap.Modal.getInstance(targetModal);
                modal.hide();
            });

            Livewire.on('open-modal', (e) => {
                const myModal = new bootstrap.Modal(document.getElementById(`${e.namamodal}`));
                myModal.show();
            });

            /**
             * Header toggle
             */

            Livewire.on('header-toggle', (e) => {
                alert();
                document.querySelector('#header').classList.toggle('header-show');
                headerToggleBtn.classList.toggle('bi-list');
                headerToggleBtn.classList.toggle('bi-x');
            });

            /**
             * Hide mobile nav on same-page/hash links
             */
            document.querySelectorAll('#navmenu a').forEach(navmenu => {
                navmenu.addEventListener('click', () => {
                    if (document.querySelector('.header-show')) {
                        headerToggle();
                    }
                });

            });

            /**
             * Toggle mobile nav dropdowns
             */
            document.querySelectorAll('.navmenu .toggle-dropdown').forEach(navmenu => {
                navmenu.addEventListener('click', function(e) {
                    e.preventDefault();
                    this.parentNode.classList.toggle('active');
                    this.parentNode.nextElementSibling.classList.toggle('dropdown-active');
                    e.stopImmediatePropagation();
                });
            });

            function aosInit() {
                AOS.init({
                    duration: 600,
                    easing: 'ease-in-out',
                    once: true,
                    mirror: false
                });
            }
            aosInit();

        });
    </script>

</body>

</html>
