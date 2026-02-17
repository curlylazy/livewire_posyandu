<div>

    @assets

    <style>
        #kegiatan {
            min-height: 100%;
            background-attachment: fixed;
            background-repeat: no-repeat;
            background: url("{{ ImageUtils::getImage($dataKegiatan->gambarkegiatan) }}");
            background-size: cover;
            box-shadow: inset 0 0 0 2000px rgba(255, 255, 255, 0.897);
        }
    </style>

    @endassets

    <section id="kegiatan" class="contact section">
        <div class="container">
            <x-partials.loader />
            <x-partials.flashmsg />

            <div class="row vh-100">
                <div class="col-md-12 text-center">
                    <img class="" src="{{ asset('logo.png') }}" style="width: 70px; height: 70px;"/>
                    <h4 class="fw-bold mt-3">{{ config('app.webname') }}</h4>
                    <h2 class="h1">{{ $dataKegiatan->namakegiatan }}</h2>
                    <h4>{{ IDateTime::formatDate($dataKegiatan->datekegiatan) }}</h4>
                    <h6>{{ $dataKegiatan->alamatkegiatan }}</h6>
                    <hr />

                    @if($isSudahHadir)
                        <div>Halo, <b>{{ Auth::guard('front')->user()->namaanggota }}</b> terima kasih sudah berpartisipasi dalam kegiatan ini</div>
                        <img class="" src="{{ asset('static/check.png') }}" />
                    @else
                        <div>Halo, <b>{{ Auth::guard('front')->user()->namaanggota }}</b> yuk lakukan absensi kegiatan ini</div>
                        <div><button class="btn btn-outline-primary btn-lg mt-3" type="button" wire:click='konfirmasi'><i class="bi bi-check-lg"></i> Konfirmasi Absen</button></div>
                    @endif

                </div>
            </div>
        </div>
    </section>
</div>
