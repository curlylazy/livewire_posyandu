<div>

    <section id="hero" class="hero section dark-background">
        <img src="{{ asset("static/cover.jpg") }}" alt="{{ config('app.webname') }}" data-aos="fade-in">
        <div class="container d-flex flex-column align-items-center">
            <h2 data-aos="fade-up" data-aos-delay="100">{{ config('app.webname') }}</h2>
            <p data-aos="fade-up" data-aos-delay="200">{{ config('app.tagline') }}</p>
            <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
                <a href="#about" class="btn-get-started">Check Our Package</a>
                <a href="{{ config('app.youtube') }}" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
            </div>
        </div>
    </section>

    <section id="welcome" class="about section">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">

                    <img src="{{ asset('static/image2.jpg') }}" class="img-fluid rounded-4 mb-4" alt="{{ config('app.webname') }}">

                </div>
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">
                    <h3>Welcome To {{ config('app.webname') }}</h3>
                    <p>Escape the tourist crowds and immerse yourself in the untouched beauty of rural Bali. Our Rural Bali Adventure takes you on a journey through lush rice terraces, traditional villages, and breathtaking landscapes where time slows down, and Balinese culture thrives.</p>
                    <div class="content">
                        <p class="fst-italic">
                            What to Expect :
                        </p>
                        <ul>
                            <li><i class="bi bi-check-circle-fill"></i> <span>Scenic Trekking & Cycling – Wander through emerald-green rice fields and cycle along peaceful countryside roads.</span></li>
                            <li><i class="bi bi-check-circle-fill"></i> <span>Cultural Experiences – Visit ancient temples, interact with local artisans, and witness time-honored traditions.</span></li>
                            <li><i class="bi bi-check-circle-fill"></i> <span>Farm & Village Life – Learn how to plant rice, taste fresh tropical fruits, and enjoy an authentic Balinese meal prepared by locals.</span></li>
                            <li><i class="bi bi-check-circle-fill"></i> <span>Hidden Waterfalls & Rivers – Discover secluded waterfalls and take a refreshing dip in natural pools.</span></li>
                        </ul>
                        <p>
                            Whether you’re seeking adventure, cultural immersion, or simply a peaceful retreat, our Rural Bali Adventure promises a unique and unforgettable experience.
                        </p>

                        {{-- <div class="position-relative mt-4">
                            <img src="{{ asset('static/image3.jpg') }}" class="img-fluid rounded-4" alt="">
                            <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn"></a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="activity" class="services section">

        <div class="container section-title" data-aos="fade-up" wire:ignore.self>
            <h2>Activities</h2>
            <p>{{ config('app.webname') }} Activities<br></p>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100" wire:ignore.self>
            <div class="row gy-5">

                @foreach ($dataActivity as $data)
                    <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="200" wire:ignore.self>
                        <div class="service-item">
                            <div class="img">
                                <img src="{{ ImageUtils::getImageThumb($data->gambaractivity) }}" class="img-fluid" alt="" style="height: 300px; width: 100%; object-fit: cover;">
                            </div>
                            <div class="details position-relative">
                                <div class="icon">
                                    <img src="{{ asset('logo.png') }}" class="img-fluid" alt="{{ config('app.webname') }}">
                                </div>
                                <a href='{{ url("activity/$data->seoactivity") }}' class="stretched-link">
                                    <h3>{{ $data->namaactivity }}</h3>
                                </a>
                                <p class="text-start">{{ Str::limit($data->keterangansingkat, 200) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="package" class="services-2 section light-background">
        <div class="container section-title" data-aos="fade-up">
            <h2>Packages</h2>
            <p>{{ config('app.webname') }} Packages<br></p>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100" wire:ignore.self>
            <div class="row justify-content-md-center">
                @foreach ($dataPackage as $data)
                    <div class="col-md-5 text-center">
                        <div class="border border-success border-2 rounded p-2">
                            <h3 class="mt-3">{{ $data->namapackage }}</h3>
                            <p>{{ $data->keterangan }}</p>
                            <h6>Activities Include</h6>
                            <ul class="list-group list-group-flush bg-transparent">
                                @foreach(json_decode($data->activityinclude) as $dataAct)
                                    <li class="list-group-item bg-transparent">{{ $dataAct }}</li>
                                @endforeach
                            </ul>
                            <hr />
                            <h2>IDR{{ Number::format($data->harga) }}</h2>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-12 text-center mt-5" data-aos="fade-up" data-aos-delay="100" wire:ignore.self>
            <a class="btn btn-lg btn-success" type="button" href="https://wa.me/{{ config('app.wa') }}"><i class="bi bi-whatsapp"></i> Contact Us</a>
        </div>

    </section>
</div>
