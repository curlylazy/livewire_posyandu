<div>

    @assets
        <link rel="stylesheet" href="{{ asset('asset_login/fonts/icomoon/style.css') }}">
        <link rel="stylesheet" href="{{ asset('asset_login/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('asset_login/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('asset_login/css/style.css') }}">

        <script src="{{ asset('asset_login/js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('asset_login/js/popper.min.js') }}"></script>
        <script src="{{ asset('asset_login/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('asset_login/js/main.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @endassets

    @script
        <script>
            $wire.on('notif', (e) => {
                Swal.fire({
                    text: e.message,
                    icon: e.icon
                });
            });
        </script>
    @endscript

    <x-partials.loader />

    <div class="d-lg-flex half">
        <div class="bg order-1 order-md-2 d-none d-xl-block" style="background-image: url('{{ asset('static/cover_2.jpg') }}');"></div>
        <div class="contents order-2 order-md-1">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7 col-12">
                        <div class="d-flex">
                            <img class="me-4" src="{{ asset('logo.png') }}" style="width: 70px; height: 70px; margin-right: 20px;"/>
                            <div class="d-flex flex-column">
                                <h3>Login Anggota <strong>{{ config('app.webname') }}</strong></h3>
                                <p class="mb-4">Untuk akses sistem ini, Anda harus memasukkan NIS dan sandi.</p>
                            </div>
                        </div>
                        <form wire:submit="login">
                            <div class="form-group first">
                                <label for="nis">NIS</label>
                                <input type="text" class="form-control" id="nis" wire:model='nis' placeholder="NIS Anda">
                            </div>
                            <div class="form-group last mb-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" wire:model='password' placeholder="Password" wire:keydown.enter='login'>
                            </div>

                            <div class="d-flex mb-5 align-items-center">
                                <label class="control control--checkbox mb-0">
                                    <span class="caption">Remember me</span>
                                    <input type="checkbox" checked="checked" wire:model='remember'/>
                                    <div class="control__indicator"></div>
                                </label>
                            </div>

                            <input type="submit" value="Log In" class="btn btn-block btn-primary">

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
