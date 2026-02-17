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
