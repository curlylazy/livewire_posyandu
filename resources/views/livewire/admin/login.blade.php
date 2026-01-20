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
                    title: "Login Info",
                    text: e.message,
                    icon: e.icon
                });
            });
        </script>
    @endscript

    <x-partials.loader />

    <div class="d-lg-flex half">
        <div class="bg order-1 order-md-2 d-none d-xl-block" style="background-image: url('{{ asset('static/login_5.png') }}');"></div>
        <div class="contents order-2 order-md-1">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7 col-12">
                        <div class="d-flex align-items-center mb-3">
                            <img class="me-4" src="{{ asset('logo.png') }}" style="width: 100px; height: 100px; margin-right: 20px; object-fit: contain;"/>
                            <div class="d-flex flex-column">
                                <h3>Login to <strong>Posyandu 6 SPM</strong></h3>
                                <p class="mb-4">{{ config('app.tagline') }}</p>
                            </div>
                        </div>
                        <form>
                            <div class="form-group first">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" wire:model='username' placeholder="Username Anda">
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

                            <button type="button" class="btn btn-block btn-primary" style="background-color: #d22b69; border-color: #d22b69;" wire:click='login'>Log In</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
