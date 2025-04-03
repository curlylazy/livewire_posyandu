<!DOCTYPE html><!--
    * CoreUI - Free Bootstrap Admin Template
    * @version v5.1.0
    * @link https://coreui.io/product/free-bootstrap-admin-template/
    * Copyright (c) 2024 creativeLabs Łukasz Holeczek
    * Licensed under MIT (https://github.com/coreui/coreui-free-bootstrap-admin-template/blob/main/LICENSE)
    -->
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

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com" rel="preconnect">
        <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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

        <header id="header" class="header d-flex flex-column justify-content-center">
            <i class="header-toggle d-xl-none bi bi-list" wire:click='$dispatch("header-toggle")'></i>
            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ url("/") }}" class="active"><i class="bi bi-house navicon"></i><span>Home</span></a></li>

                    @if(Auth::guard('front')->check())
                        <li><a href="{{ url("/profile") }}"><i class="bi bi-person navicon"></i><span>Profile</span></a></li>
                        <li><a href="{{ url("/absensi/dashboard") }}"><i class="bi bi-journal-check"></i><span>Absensi</span></a></li>
                        <li><a href="{{ url("/kegiatan") }}"><i class="bi bi-bell"></i><span>Kegiatan</span></a></li>
                    @else
                        <li><a href="{{ url("/login") }}"><i class="bi bi-person navicon"></i><span>Login</span></a></li>
                    @endif

                    <li><a href="{{ url("/blog") }}"><i class="bi bi-file-earmark-text navicon"></i><span>Blog</span></a></li>
                </ul>
            </nav>
        </header>

        <main class="main">
            {{ $slot }}
        </main>

        <!-- Scroll Top -->
        <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <!-- Preloader -->
        <div id="preloader"></div>

        <!-- Vendor JS Files -->
        <script src="{{ asset('asset_front/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('asset_front/vendor/php-email-form/validate.js') }}"></script>
        <script src="{{ asset('asset_front/vendor/aos/aos.js') }}"></script>
        <script src="{{ asset('asset_front/vendor/typed.js/typed.umd.js') }}"></script>
        <script src="{{ asset('asset_front/vendor/purecounter/purecounter_vanilla.js') }}"></script>
        <script src="{{ asset('asset_front/vendor/waypoints/noframework.waypoints.js') }}"></script>
        <script src="{{ asset('asset_front/vendor/glightbox/js/glightbox.min.js') }}"></script>
        <script src="{{ asset('asset_front/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
        <script src="{{ asset('asset_front/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('asset_front/vendor/swiper/swiper-bundle.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sharer.js@0.5.2/sharer.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Main JS File -->
        <script src="{{ asset('asset_front/js/main.js') }}"></script>

        {!! $js ?? '' !!}

        <script>
            document.addEventListener('livewire:init', (event) => {

                Livewire.on('notif', (e) => {
                    Swal.fire({
                        text: e.message,
                        icon: e.icon
                    });
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

        {{--
            ***tribute to storyset
            <a href="https://storyset.com/work">Work illustrations by Storyset</a>
        --}}

        {{--
        *** Flat Icon
        <a href="https://www.flaticon.com/free-icons/shalat" title="shalat icons">Shalat icons created by Slamlabs - Flaticon</a>
         --}}
    </body>
</html>
