<?php

use App\Lib\MetaTag;
use Livewire\Component;

new class extends Component
{
    public $pageTitle = "Berita";

    public function render()
    {
        $mt = new MetaTag;
        $mt->title = "Berita | ".config('app.webname');
        $mt->url = url('/berita');
        $mt->description = "Berita - Coming Soon";
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
                <div class="col-12 text-center">
                    <img src="{{ asset("coming_soon.jpg") }}" alt="Coming Soon" class="img-fluid mb-4 rounded rounded-3" style="max-width:720px;">
                    <p class="lead text-muted mx-auto" style="max-width:720px;">
                        Halaman Berita sedang dalam pengerjaan. Kami sedang menyiapkan artikel, pengumuman, dan laporan kegiatan Posyandu
                        agar informasinya bermanfaat dan terpercaya. Silakan kembali nanti untuk pembaruan — terima kasih atas kesabaran Anda.
                    </p>
                    <a href="{{ url('/') }}" class="btn btn-primary mt-3">Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </section>
</div>
