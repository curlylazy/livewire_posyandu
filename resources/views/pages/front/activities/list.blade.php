<div>
    <div class="page-title dark-background">
        <div class="container position-relative">
            <h1>{{ config('app.webname') }} {{ $pageTitle }}</h1>
            <p>Adventure Awaits – Travel, Explore, Experience!</p>
        </div>
    </div>

    <section id="activity" class="services section">
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
                                <a href='{{ url("activities/$data->seoactivity") }}' class="stretched-link">
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
</div>
