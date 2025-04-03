<div>


    <div class="page-title dark-background">
        <div class="container position-relative">
            <h1>{{ $dataActivity->namaactivity }}</h1>
            <p>{{ config('app.webname') }} Activities</p>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url("/activities") }}">Activities</a></li>
                    <li class="current">{{ $dataActivity->namaactivity }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <section id="service-details" class="service-details section">
        <div class="container">
            <div class="row gy-5">
                <div class="col-lg-8 ps-lg-5" data-aos="fade-up" data-aos-delay="200" wire:ignore.self>
                    <img src="{{ ImageUtils::getImage($dataActivity->gambaractivity) }}" alt="{{ $dataActivity->namaactivity }}" class="img-fluid services-img rounded-3" style="height: 600px; width: 100%; object-fit: cover;">
                    <h3>{{ $dataActivity->namaactivity }}</h3>
                    <p>
                        {!! $dataActivity->keterangan !!}
                    </p>

                    <div class="row mt-4">
                        <h4>Galeri Activities</h4>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach ($dataGaleriActivity as $data)
                                <div>
                                    <a href="{{ ImageUtils::getImage($data->gambargaleriactivity) }}" class="glightbox" data-gallery="images-gallery">
                                        <img src="{{ ImageUtils::getImageThumb($data->gambargaleriactivity) }}" style="height: 200px; width: 200px; object-fit: cover;" class="rounded-3"/>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100" wire:ignore.self>
                    <div class="service-box">
                        <h4>Other Activities</h4>
                        <div class="services-list">
                            @foreach ($dataActivityLainnya as $data)
                                <a href="{{ url("/activities/$data->seoactivity") }}"><span>{{ $data->namaactivity }}</span></a>
                            @endforeach
                        </div>
                    </div>

                    <div class="service-box mt-4">
                        <h4>Contact Us</h4>
                        <a class="btn btn-lg btn-success w-100" type="button" href="https://wa.me/{{ config('app.wa') }}"><i class="bi bi-whatsapp"></i> Contact Us</a>
                    </div>

                </div>
            </div>
        </div>
    </section>

</div>
