<div>
    <x-partials.loader />

    <div class="page-title dark-background">
        <div class="container position-relative">
            <h1>{{ config('app.webname') }} {{ $pageTitle }}</h1>
            <p>Adventure Awaits – Travel, Explore, Experience!</p>
        </div>
    </div>

    <section id="package" class="services-2 section light-background">
        <div class="container" data-aos="fade-up" data-aos-delay="100" wire:ignore.self>
            <div class="row justify-content-md-center">
                @foreach ($dataPackage as $data)
                    <div class="col-md-5 text-center" role="button" wire:click='detailPackage("{{ $data->kodepackage }}")'>
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

                <div class="col-12 text-center mt-5">
                    <a class="btn btn-lg btn-success" type="button" href="https://wa.me/{{ config('app.wa') }}"><i class="bi bi-whatsapp"></i> Contact Us</a>
                </div>
            </div>
        </div>
    </section>

    @if(!empty($dataActivity))
        <section id="activity" class="services section">
            <div class="container section-title" data-aos="fade-up" wire:ignore.self>
                <h2>{{ $packageName }}</h2>
                <p>{{ $packageName }}<br></p>
            </div>

            <div class="container" data-aos="fade-up" data-aos-delay="100" wire:ignore.self>
                <div class="row gy-5">

                    <h5 class="fw-normal">With <b>{{ $packageName }}</b> you will include all of activities below</h5>
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
    @endif
</div>
