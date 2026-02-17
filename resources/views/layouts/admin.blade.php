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
        <meta name="description" content="{{ config('app.webname') }} - {{ config('app.tagline') }}">
        <meta name="author" content="Balicoding.com">
        <meta name="keyword" content="">
        <meta name="robots" content="noindex">
        <title>{{ $title ?? 'Admin '.config('app.webname') }}</title>


        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Vendors styles-->
        <link rel="stylesheet" href="{{ asset('asset_admin/vendors/simplebar/css/simplebar.css') }}">
        <link rel="stylesheet" href="{{ asset('asset_admin/css/vendors/simplebar.css') }}">
        <link rel="stylesheet" href="{{ asset('asset_admin/css/style.css') }}">

        <script src="{{ asset('asset_admin/js/config.js') }}"></script>

        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('site.webmanifest') }}">

        @vite('resources/js/app.js')

    </head>
    <body>

    <div class="sidebar sidebar-dark sidebar-fixed border-end" id="sidebar">
        <div class="sidebar-header border-bottom">
            <div class="sidebar-brand">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('logo.png') }}" style="width: 35px; margin-right: 10px;" />
                    <div class="fs-5">Posyandu</div>
                </div>
                {{-- <svg class="sidebar-brand-full" width="88" height="32" alt="CoreUI Logo">
                    <use xlink:href="{{ asset('asset_admin/assets/brand/coreui.svg#full') }}"></use>
                </svg>
                <svg class="sidebar-brand-narrow" width="32" height="32" alt="CoreUI Logo">
                    <use xlink:href="{{ asset('asset_admin/assets/brand/coreui.svg#signet') }}"></use>
                </svg> --}}
            </div>
            <button class="btn-close d-lg-none" type="button" data-coreui-theme="dark" onclick='Livewire.dispatch("close-sidebar")'></button>
        </div>
        <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">

            @role('admin')
                <li class="nav-title">Master Data</li>
                <x-partials.sidelink href="admin/" icon="home" title="Beranda" />
                <x-partials.sidelink href="admin/user" icon="person" title="User" />
                <x-partials.sidelink href="admin/pasien" icon="pregnancy" title="Pasien" />
                <x-partials.sidelink href="admin/posyandu" icon="family_home" title="Posyandu" />
            @endrole

            <li class="nav-title">Pemeriksaan</li>
            @role('staff')
                <x-partials.sidelink href="admin/pasien" icon="pregnancy" title="Pasien" />
            @endrole
            <x-partials.sidelink href="admin/pemeriksaan/bumilnifas?kategori_periksa=bumil" icon="stethoscope" title="Periksa Ibu Hamil" />
            <x-partials.sidelink href="admin/pemeriksaan/bumilnifas?kategori_periksa=nifas" icon="stethoscope" title="Periksa Nifas" />
            <x-partials.sidelink href="admin/pemeriksaan/bayi" icon="stethoscope" title="Periksa Bayi" />
            <x-partials.sidelink href="admin/blog" icon="news" title="Blog" />

            <li class="nav-title">Laporan</li>
            <x-partials.sidelink href="admin/laporan/riwayat/bumilnifas?kategori_periksa=bumil" icon="medical_information" title="Riwayat Ibu Hamil" />
            <x-partials.sidelink href="admin/laporan/riwayat/bumilnifas?kategori_periksa=nifas" icon="medical_information" title="Riwayat Ibu Nifas" />
            <x-partials.sidelink href="admin/laporan/riwayat/bayi" icon="medical_information" title="Riwayat Bayi" />
            <x-partials.sidelink href="admin/laporan/rekapbumilnifas" icon="medical_information" title="Rekap Bumil & Nifas" />
            <x-partials.sidelink href="admin/laporan/rekapbayi" icon="medical_information" title="Rekap Periksa Bayi" />
            <x-partials.sidelink href="admin/laporan/pemeriksaan?kategori_periksa=bumil" icon="lab_profile" title="Lap Periksa Bumil" />
            <x-partials.sidelink href="admin/laporan/pemeriksaan?kategori_periksa=nifas" icon="lab_profile" title="Lap Periksa Nifas" />
            <x-partials.sidelink href="admin/laporan/pemeriksaan/bayi" icon="lab_profile" title="Lap Periksa Bayi" />
            <x-partials.sidelink href="admin/laporan/grafik_pasien" icon="bar_chart" title="Grafik Pasien" />
            <x-partials.sidelink href="admin/laporan/grafik_pemeriksaan" icon="bar_chart" title="Grafik Pemeriksaan" />

            {{-- LOG OUT --}}
            <li class="nav-item">
                <a type="button" role="button" class="nav-link text-danger fw-bold" href="javascript:void(0)" onclick='Livewire.dispatch("notif-confirm-logout")'>
                    <span class="nav-icon material-symbols-outlined text-danger fw-bold">power_settings_new</span>
                    Log Out
                </a>
            </li>
        </ul>
        <div class="sidebar-footer border-top d-none d-md-flex">
            <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
        </div>
    </div>


    <div class="wrapper d-flex flex-column min-vh-100">
        <header class="header header-sticky p-0 mb-4">
            <div class="container-fluid border-bottom px-4">
                <button class="header-toggler" type="button" onclick='Livewire.dispatch("toggle-sidebar")' style="margin-inline-start: -14px;">
                    <span class="icon icon-lg material-symbols-outlined">menu</span>
                </button>
                <ul class="header-nav d-none d-lg-flex">
                    <li class="nav-item"><a class="nav-link" href="{{ url('admin/') }}">Dashboard</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-user me-2"></i>
                            {{ Auth::user()->namauser }}
                        </a>
                    </li>
                </ul>
                <ul class="header-nav mx-auto">
                    <li class="nav-item d-lg-none">
                        <span class="fw-bold">{{ $pageTitle ?? "POSYANDU" }}</span>
                    </li>
                    {{-- <li class="nav-item"><a class="nav-link" href="#">
                        <svg class="icon icon-lg">
                            <use xlink:href="{{ asset('asset_admin/vendors/@coreui/icons/svg/free.svg#cil-bell') }}"></use>
                        </svg></a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#">
                        <svg class="icon icon-lg">
                            <use xlink:href="{{ asset('asset_admin/vendors/@coreui/icons/svg/free.svg#cil-list-rich') }}"></use>
                        </svg></a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#">
                        <svg class="icon icon-lg">
                            <use xlink:href="{{ asset('asset_admin/vendors/@coreui/icons/svg/free.svg#cil-envelope-open') }}"></use>
                        </svg></a>
                    </li> --}}
                </ul>
                <ul class="header-nav">
                    {{-- <li class="nav-item py-1">
                        <div class="vr h-100 mx-2 text-body text-opacity-75"></div>
                    </li>
                    <li class="nav-item dropdown">
                        <button class="btn btn-link nav-link py-2 px-2 d-flex align-items-center" type="button" aria-expanded="false" data-coreui-toggle="dropdown">
                            <svg class="icon icon-lg theme-icon-active">
                                <use xlink:href="{{ asset('asset_admin/vendors/@coreui/icons/svg/free.svg#cil-contrast') }}"></use>
                            </svg>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" style="--cui-dropdown-min-width: 8rem;">
                            <li>
                                <button class="dropdown-item d-flex align-items-center" type="button" data-coreui-theme-value="light">
                                    <svg class="icon icon-lg me-3">
                                        <use xlink:href="{{ asset('asset_admin/vendors/@coreui/icons/svg/free.svg#cil-sun') }}"></use>
                                    </svg>Light
                                </button>
                            </li>
                            <li>
                                <button class="dropdown-item d-flex align-items-center" type="button" data-coreui-theme-value="dark">
                                    <svg class="icon icon-lg me-3">
                                        <use xlink:href="{{ asset('asset_admin/vendors/@coreui/icons/svg/free.svg#cil-moon') }}"></use>
                                    </svg>Dark
                                </button>
                            </li>
                            <li>
                                <button class="dropdown-item d-flex align-items-center active" type="button" data-coreui-theme-value="auto">
                                    <svg class="icon icon-lg me-3">
                                        <use xlink:href="{{ asset('asset_admin/vendors/@coreui/icons/svg/free.svg#cil-contrast') }}"></use>
                                    </svg>Auto
                                </button>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item py-1">
                        <div class="vr h-100 mx-2 text-body text-opacity-75"></div>
                    </li> --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link py-0 pe-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            <div class="avatar avatar-md">
                                <img class="avatar-img" src="{{ asset('logo.png') }}" />
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end pt-0">
                            <div class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold rounded-top mb-2">Account</div>
                            <a class="dropdown-item" href="#">
                                <span class="icon me-2 material-symbols-outlined">key</span>
                                Ganti Password
                            </a>
                            <livewire:partial.admin-btn-logout />
                        </div>
                    </li>
                </ul>
            </div>
            <div class="px-2 py-2 d-none d-lg-block">
                <div class="container-fluid">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb my-0">
                            {!! $bc ?? '<li class="breadcrumb-item active"><span>Home</span></li>' !!}
                        </ol>
                    </nav>
                </div>
            </div>
        </header>
        <div class="body flex-grow-1">
            <div class="container-xl px-2">
                {{ $slot }}
            </div>
        </div>
        {{-- <footer class="footer px-4">
            <div>{{ config('app.webname') }}</div>
            <div><a href="https://coreui.io">CoreUI </a><a href="https://coreui.io/product/free-bootstrap-admin-template/">Bootstrap Admin Template</a> © 2024 creativeLabs.</div>
            <div class="ms-auto">Powered by &nbsp;<a href="https://coreui.io/docs/">CoreUI UI Components</a></div>
        </footer> --}}
    </div>

    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('asset_admin/vendors/@coreui/coreui/js/coreui.bundle.min.js') }}"></script>
    <script src="{{ asset('asset_admin/vendors/simplebar/js/simplebar.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sharer.js@0.5.2/sharer.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>

        document.addEventListener('livewire:navigated', (event) => {

            const mySidebar = document.querySelector('#sidebar');
            const sidebar = new coreui.Sidebar(mySidebar);

            Livewire.on('toggle-sidebar', (e) => {
                sidebar.toggle();
            });

            Livewire.on('close-sidebar', (e) => {
                sidebar.hide();
            });

        });

        document.addEventListener('livewire:init', () => {

            const header = document.querySelector('header.header');
            document.addEventListener('scroll', () => {
            if (header) {
                    header.classList.toggle('shadow-sm', document.documentElement.scrollTop > 0);
                }
            });

            Livewire.on('notif-not-login', (e) => {
                Swal.fire({
                    html: `
                        Anda belum melakukan login <a href='{{ url("login") }}'>Login Sekarang</a>,
                        atau jika belum memiliki akun <a href='{{ url("registrasi") }}'>Registrasi Sekarang</a>
                    `,
                    icon: "error"
                });
            });

            Livewire.on('notif-confirm-logout', (e) => {
                Swal.fire({
                    title: "Keluar dari Sistem ?",
                    text: "Apakah anda ingin keluar dari sistem sekarang ?",
                    icon: "question",
                    showCancelButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('on-logout');
                    }
                });
            });

            Livewire.on('copy-to-clipboard', (e) => {
                navigator.clipboard.writeText(e.url);
                Livewire.dispatch('notif', { message: "Berhasil copy URL, silahkan paste URL tersebut di platform mana saja.", icon: "success" });
            });

            Livewire.on('notif', (e) => {
                Swal.fire({
                    text: e.message,
                    icon: e.icon
                });
            });

            Livewire.on('close-modal', (e) => {
                const targetModal = document.querySelector(`#${e.namamodal}`);
                const modal = coreui.Modal.getInstance(targetModal);
                modal.hide();
            });

            Livewire.on('open-modal', (e) => {
                const myModal = new coreui.Modal(document.getElementById(`${e.namamodal}`));
                myModal.show();
            });

        });
    </script>

    {!! $js ?? '' !!}

    {{-- tribute to storyset --}}
    {{-- <a href="https://storyset.com/work">Work illustrations by Storyset</a> --}}
    </body>
</html>
