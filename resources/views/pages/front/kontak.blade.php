<?php

use App\Lib\MetaTag;
use Livewire\Component;

new class extends Component
{
    public $pageTitle = "Kontak";

    public function mount()
    {
    }

    public function render()
    {
        $mt = new MetaTag;
        $mt->title = "Kontak | ".config('app.webname');
        $mt->url = url('/kontak');
        $mt->description = "Kontak Posyandu";
        $mt->genMetaTag();

        return $this->view()->layout('layouts.front');
    }
};

?>

<div>

    {{-- Hero Section --}}
    <section class="page-title dark-background" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset("static/cover3.jpg") }}') center/cover no-repeat; padding: 80px 0 60px;">
        <div class="container text-center" wire:ignore>
            <h1 class="text-white fw-bold display-5" data-aos="fade-up">{{ $pageTitle }}</h1>
            <p class="text-white-50 mt-2" data-aos="fade-up" data-aos-delay="100">
                Hubungi Posyandu kami melalui informasi berikut
            </p>
        </div>
    </section>

    <section id="starter-section" class="contact section light-background">
        <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100" wire:ignore.self>
            <div class="row gy-4">
                <div class="col-lg-5">
                    <div class="row gy-4">
                        <div class="col-lg-12">
                            <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
                                <i class="bi bi-geo-alt"></i>
                                <h3>Alamat</h3>
                                <p class="text-center">{{ config('app.alamat') }}<br />
                                    {{ config('app.alamat2') }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
                                <i class="bi bi-telephone"></i>
                                <h3>Whatsapp</h3>
                                <p><a href="https://wa.me/{{ config('app.wa') }}">{{ config('app.wa') }}</a></p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400">
                                <i class="bi bi-envelope"></i>
                                <h3>Email Us</h3>
                                <p><a href="mailto:{{ config('app.email') }}">{{ config('app.email') }}</a></p>
                            </div>
                        </div>

                        <div class="col-12 mt-3">
                            <div class="d-flex gap-3">
                                <a href="https://instagram.com/dummy_account" target="_blank" rel="noopener" class="btn btn-outline-primary"><i class="bi bi-instagram"></i> Instagram</a>
                                <a href="https://www.tiktok.com/@dummy_account" target="_blank" rel="noopener" class="btn btn-outline-dark"><i class="bi bi-tiktok"></i> TikTok</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 maps">
                    <h3>Lokasi (Google Maps)</h3>
                    <p>Gunakan peta berikut untuk melihat lokasi Posyandu. (Link asli: <a href="https://maps.app.goo.gl/ZZiKqp2tcZaGcNCNA" target="_blank" rel="noopener">Buka di Google Maps</a>)</p>

                    <div style="width:100%; height:360px;">
                        <iframe
                            src="https://maps.google.com/maps?q=ZZiKqp2tcZaGcNCNA&output=embed"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
