<div>

    @assets

    <style>
        #kegiatan {
            min-height: 100%;
            background-attachment: fixed;
            background-repeat: no-repeat;
            background: url("{{ ImageUtils::getImage($dataBlog->gambarblog) }}");
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
                <div class="col-md-9">
                    <img src="{{ ImageUtils::getImageThumb($dataBlog->gambarblog) }}" class="rounded" style="height: 350px; width: 100%; object-fit: cover;"/>
                    <h2 class="h2 mt-3">{{ $dataBlog->judulblog }}</h2>

                    <div class="d-flex gap-2">
                        <div><i class="bi bi-facebook fs-4"></i></div>
                        <div><i class="bi bi-whatsapp fs-4"></i></div>
                    </div>

                    {!! $dataBlog->isiblog !!}
                </div>
                <div class="col-md-3">
                    <h4>Blog Lainnya</h4>
                    <hr />
                    <div class="row">
                        @foreach ($dataBlogLainnya as $row)
                            <div class="col-12">
                                <h6>{{ IDateTime::formatDate($row->created_at) }}</h6>
                                <h5>{{ $row->judulblog }}</h5>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
