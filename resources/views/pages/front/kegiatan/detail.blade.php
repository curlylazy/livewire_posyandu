<div>

    @assets

    <style>
        #kegiatan {
            min-height: 100%;
            background-attachment: fixed;
            background-repeat: no-repeat;
            background: url("{{ ImageUtils::getImage($dataKegiatan->gambarkegiatan) }}");
            background-size: cover;
            box-shadow: inset 0 0 0 2000px rgba(255, 255, 255, 0.897);
        }
    </style>

    @endassets

    <section id="kegiatan" class="contact section">
        <div class="container">
            <x-partials.loader />
            <x-partials.flashmsg />

            <div class="row">
                <div class="col-md-4">
                    <img src="{{ ImageUtils::getImageThumb($dataKegiatan->gambarkegiatan) }}" class="rounded" style="height: 250px; width: 100%; object-fit: cover;"/>
                </div>
                <div class="col-md-8">
                    <h2 class="h1">{{ $dataKegiatan->namakegiatan }}</h2>
                    <hr />
                    <div class="h5 fw-normal"><i class="fas fa-users me-2"></i>{{ $totalanggota }} Anggota</div>
                    <div class="h5 fw-normal"><i class="fas fa-calendar me-2"></i>Tanggal : {{ IDateTime::formatDate($dataKegiatan->datekegiatan) }}</div>
                    <div class="h5 fw-normal"><i class="fas fa-map-marker-alt me-2"></i>Lokasi : {{ $dataKegiatan->alamatkegiatan }}</div>
                </div>
            </div>

            <div class="col-12 mt-4">
                <div>
                    <b>Keterangan Kegiatan</b> : <br />
                    {!! $dataKegiatan->isikegiatan !!}
                </div>
            </div>

            <div class="row mt-5">
                <h4>Kegiatan Lainnya</h4>
                @foreach ($dataKegiatanLainnya as $row)
                    <div class="col-md-2 col-12" role="button">
                        <a href="{{ url("/kegiatan/$row->seokegiatan") }}">
                            <div class="position-relative">
                                <img src="{{ ImageUtils::getImageThumb($row->gambarkegiatan) }}" class="rounded" style="height: 150px; width: 100%; object-fit: cover;"/>
                                <div class="position-absolute bottom-0 end-0 p-2">
                                    @if ($row->datekegiatan > date('Y-m-d'))
                                        <div class="mb-2"><span class="badge text-bg-warning">Upcoming Events</span></div>
                                    @else
                                        <div class="mb-2"><span class="badge text-bg-secondary">Sudah Selesai</span></div>
                                    @endif
                                    <div class="text-end"><span class="badge text-bg-primary">{{ IDateTime::formatDate($row->datekegiatan) }}</span></div>
                                </div>
                            </div>
                            <div class="d-flex flex-column text-start">
                                <h6 class="mt-1 text-justify">{{ Str::limit($row->namakegiatan, 100) }}</h6>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
</div>
