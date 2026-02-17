<div>

    <x-partials.loader />

    <div class="page-title dark-background">
        <div class="container position-relative">
            <h1>Galery {{ config('app.webname') }}</h1>
            <p>Unforgettable Moments, One Click at a Time</p>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">Galery</li>
                </ol>
            </nav>
        </div>
    </div>

    <section id="starter-section" class="starter-section section">
        <div class="container mt-2" data-aos="fade-up" wire:ignore.self>
            <div class="row g-3">
                @foreach ($dataGaleri as $data)
                    <div class="col-md-3 col-12">
                        <a href="{{ ImageUtils::getImage($data->gambargaleri) }}" class="glightbox img-galeri" data-glightbox="title: {{ $data->namagaleri }};">
                            <img src="{{ ImageUtils::getImageThumb($data->gambargaleri) }}" style="width: 100%; height: 200px; object-fit: cover;" />
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

</div>
