<?php

use App\Lib\MetaTag;
use App\Models\PasienModel;
use App\Models\PemeriksaanModel;
use Livewire\Component;

new class extends Component
{
    public $jmlPasien = 0;
    public $jmlPeriksaBulanIni = 0;
    public $jmlPeriksaTahunIni = 0;
    public $jmlBalita = 0;
    public $jmlAnakAnak = 0;
    public $jmlRemaja = 0;
    public $jmlDewasa = 0;
    public $jmlLansia = 0;

    public function mount()
    {
        $this->jmlPasien = PasienModel::count();
        $this->jmlPeriksaTahunIni = PemeriksaanModel::searchByYear(date('Y'))->count();
        $this->jmlPeriksaBulanIni = PemeriksaanModel::searchByMonthYear(date('m'), date('Y'))->count();
        $this->jmlBalita = PasienModel::selectCustom()->searchByKategoriUmur('Balita')->count();
        $this->jmlAnakAnak = PasienModel::selectCustom()->searchByKategoriUmur('Anak-anak')->count();
        $this->jmlRemaja = PasienModel::selectCustom()->searchByKategoriUmur('Remaja')->count();
        $this->jmlDewasa = PasienModel::selectCustom()->searchByKategoriUmur('Dewasa')->count();
        $this->jmlLansia = PasienModel::selectCustom()->searchByKategoriUmur('Lansia')->count();
    }

    public function readAboutUs()
    {
        $res = collect([
            (object)[
                'title' => 'Pelayanan Terpercaya',
                'description' => 'Tenaga kesehatan yang ramah dan profesional siap memberikan pelayanan terbaik untuk masyarakat.',
                'icon' => 'bi-hospital',
            ],
            (object)[
                'title' => 'Pemantauan Berkala',
                'description' => 'Kami melakukan pemeriksaan rutin seperti penimbangan, pengukuran tinggi badan, serta pemantauan gizi anak.',
                'icon' => 'bi-clipboard-data',
            ],
            (object)[
                'title' => 'Edukasi Kesehatan',
                'description' => 'Menyediakan informasi dan penyuluhan seputar gizi, imunisasi, serta pola asuh anak untuk orang tua.',
                'icon' => 'bi-book',
            ],
            (object)[
                'title' => 'Pertumbuhan & Perkembangan',
                'description' => 'Mendukung anak agar tumbuh sehat, cerdas, dan bahagia sesuai tahapan usianya.',
                'icon' => 'bi-graph-up-arrow',
            ],
        ]);

        return $res;
    }

    public function render()
    {
        // *** meta tag
        $mt = new MetaTag;
        $mt->title = config('app.tagline')." | ".config("app.webname");
        $mt->url = url('/');
        $mt->genMetaTag();

        return $this->view()
            ->with(['dataAbout' => $this->readAboutUs()])
            ->layout('layouts.front');
    }
};

?>

{{-- *** Views --}}
<div>
    <section id="hero" class="hero section dark-background">
        <img src="{{ asset("static/cover3.jpg") }}" alt="{{ config('app.webname') }}" data-aos="fade-in">
        <div class="container">
            <div class="row">
                <div class="col-lg-10">
                    <div><img data-aos="fade-up" data-aos-delay="100" src="{{ asset('logo.png') }}" class="mb-4" style="width: 150px; object-fit: contain; position: relative;" /></div>
                    <div data-aos="fade-up" data-aos-delay="100" class="h4 text-warning fw-bold">Selamat Datang</div>
                    <h1 class="display-4" data-aos="fade-up" data-aos-delay="200">Website {{ config('app.webname') }}</h1>
                    <h2 class="fs-5 fw-normal" data-aos="fade-up" data-aos-delay="300">{{ config('app.tagline2')}}</h2>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="about section light-background">
        <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
            <div class="row align-items-xl-center gy-5">

                <div class="col-xl-5 content">
                    <h3>Tentang Kami</h3>
                    <h2>{{ config('app.webname') }}</h2>
                    <p>Kami hadir untuk memberikan layanan kesehatan yang lebih dekat dengan masyarakat. Melalui pemantauan rutin, edukasi, dan pendampingan, kami berkomitmen untuk mendukung tumbuh kembang anak serta kesehatan keluarga secara berkesinambungan</p>
                    <a href="#" class="read-more"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
                </div>

                <div class="col-xl-7">
                    <div class="row gy-5 icon-boxes">
                        @php
                            $aos = 200;
                        @endphp

                        @foreach ($dataAbout as $data)
                            <div class="col-md-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="{{ $aos }}">
                                <div class="icon-box">
                                    <i class="bi {{ $data->icon }}"></i>
                                    <h3>{{ $data->title }}</h3>
                                    <p>{{ $data->description }}</p>
                                </div>
                            </div>

                            @php
                                $aos = $aos + 100;
                            @endphp
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="stats" class="stats section dark-background">

        <img src="{{ asset("static/cover5.jpg") }}" alt="" data-aos="fade-in" class="aos-init aos-animate">

        <div class="container position-relative aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">
                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="{{ $jmlBalita + $jmlAnakAnak }}" data-purecounter-duration="0" class="purecounter">{{ $jmlBalita + $jmlAnakAnak }}</span>
                        <p>Balita & Anak</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="{{ $jmlRemaja }}" data-purecounter-duration="0" class="purecounter">{{ $jmlRemaja }}</span>
                        <p>Remaja</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="{{ $jmlDewasa }}" data-purecounter-duration="0" class="purecounter">{{ $jmlDewasa }}</span>
                        <p>Dewasa</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="{{ $jmlLansia }}" data-purecounter-duration="0" class="purecounter">{{ $jmlLansia }}</span>
                        <p>Lansia</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="about section light-background">
        <div class="container section-title aos-init aos-animate" data-aos="fade-up">
            <h2>Galeri Kegiatan</h2>
            <p>Galeri ini menampilkan momen-momen Posyandu yang melayani semua usia, dari bayi hingga lansia, dalam semangat kebersamaan</p>
        </div>

        <div class="container">
            <div class="row g-3">
                @for ($i = 1; $i <= 10; $i++)
                    <div class="col-12 col-md-3">
                        <a href="{{ asset("galeri/".$i.".jpg") }}" class="glightbox img-galeri" data-glightbox="title: galeri web;">
                            <img class="img-thumbnail" src="{{ asset("galeri/".$i.".jpg") }}" style="width: 100%; height: 250px; object-fit: cover;" />
                        </a>
                    </div>
                @endfor
            </div>
        </div>
    </section>
</div>
