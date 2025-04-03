<div>
    <section id="kegiatan" class="contact section">
        <div class="container section-title">
            <h2>{{ $pageTitle }}</h2>
        </div>
        <div class="container">
            <x-partials.loader />
            <x-partials.flashmsg />

            <div class="col-12 col-md-4 mb-4">
                <input type="text" class="form-control" placeholder="masukkan kata kunci pencarian..." wire:model='katakunci' wire:keydown.enter='$commit'>
            </div>
            <div class="row">
                @foreach ($dataKegiatan as $row)
                    <div class="col-md-4 col-12" role="button">
                        <a href="{{ url("/kegiatan/$row->seokegiatan") }}">
                            <div class="card">
                                <div class="position-relative">
                                    <img src="{{ ImageUtils::getImageThumb($row->gambarkegiatan) }}" class="card-img-top" style="height: 250px; width: 100%; object-fit: cover;"/>
                                    <div class="position-absolute bottom-0 end-0 p-2">
                                        @if ($row->datekegiatan > date('Y-m-d'))
                                            <div class="mb-2"><span class="badge text-bg-warning">Upcoming Events</span></div>
                                        @else
                                            <div class="mb-2"><span class="badge text-bg-secondary">Sudah Selesai</span></div>
                                        @endif
                                        <div class="text-end"><span class="badge text-bg-primary">{{ IDateTime::formatDate($row->datekegiatan) }}</span></div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-column text-start">
                                        <div class="fs-sm text-secondary">{{ IDateTime::formatDate($row->datekegiatan) }}</div>
                                        <div class="fs-sm"><i class="fas fa-map-marker-alt"></i> {{ $row->alamatkegiatan }}</div>
                                        <h5 class="mt-1 text-justify">{{ Str::limit($row->namakegiatan, 100) }}</h5>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

                {{ $dataKegiatan->links() }}
            </div>
        </div>
    </section>
</div>
