<div>

    @assets

    <style>
    </style>

    @endassets

    <section id="kegiatan" class="contact section">
        <div class="container">
            <x-partials.loader />
            <x-partials.flashmsg />

            <div class="row">
                <div class="col-12 col-md-3">
                    <h6>Total Kegiatan</h6>
                    <h5>{{ $totalKegiatan }}</h5>
                </div>
                <div class="col-12 col-md-3">
                    <h6>Total Kehadiran</h6>
                    <h5>{{ $totalKegiatanHadir }}</h5>
                </div>
                <div class="col-12 col-md-3">
                    <h6>Total Tidak Hadir</h6>
                    <h5>{{ $totalKegiatanTidakHadir }}</h5>
                </div>
            </div>

            <div class="row">
                @foreach ($dataKegiatan as $row)
                    <div class="col-12">
                        <div class="d-flex">
                            <div><img src="{{ ImageUtils::getImageThumb($row->gambarkegiatan) }}" class="card-img-top" style="height: 250px; width: 250px; object-fit: cover;"/></div>
                            <div class="d-flex flex-column">
                                <div class="fs-sm text-secondary">{{ IDateTime::formatDate($row->datekegiatan) }}</div>
                                <h5 class="mt-1 text-justify">{{ Str::limit($row->namakegiatan, 100) }}</h5>
                                <h5>{!! GetString::getKehadiran($row->kehadiran, true) !!}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
</div>
