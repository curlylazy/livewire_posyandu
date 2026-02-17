<div>

    <x-partials.loader />
    <x-partials.video.modaldetailvideo :detailVideo="$detailVideo" />

    <div class="page-title dark-background">
        <div class="container position-relative">
            <h1>Video {{ config('app.webname') }}</h1>
            <p>Travel Through Our Lens – Explore Iconic Destinations!</p>
        </div>
    </div>

    <section id="starter-section" class="starter-section section">
        <div class="container mt-2" data-aos="fade-up" wire:ignore.self>
            <div class="row g-3">
                @foreach ($dataVideo as $data)
                    <div class="col-md-4 col-12">
                        <div class="position-relative">
                            <div class="position-absolute top-0 start-0">
                                <img src="{{ asset("static/youtube.png") }}" style="width: 80px; height: 80px;" />
                            </div>
                            <div class="position-absolute bottom-0 end-0 p-2">
                                <div class="bg-light text-dark p-2 mb-2 bg-opacity-75 rounded rounded-1">
                                    <h6>{{ IDateTime::formatDate($data->publishedAt) }}</h6>
                                    <h5>{{ $data->title }}</h5>
                                </div>
                            </div>
                            <img src="{{ $data->thumbnails }}" style="width: 100%; height: 250px; object-fit: cover;" role="button" wire:click='detail("{{ $data->videoID }}")' class="rounded rounded-3"/>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

</div>
