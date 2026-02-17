<div>
    <section id="kegiatan" class="contact section">
        <div class="container section-title">
            <h2>{{ $pageTitle }}</h2>
        </div>

        <div class="container">
            <x-partials.loader />
            <x-partials.flashmsg />

            <div class="col-12 col-md-4 mb-4">
                <input type="text" class="form-control mt-2" placeholder="masukkan kata kunci pencarian..." wire:model='katakunci' wire:keydown.enter='$commit'>
            </div>

            <div class="row">

                @if($dataKegiatan->isEmpty())
                    <div class="col-12">
                        <h4>Belum Blog Saat Ini..</h4>
                    </div>
                @endif

                @foreach ($dataKegiatan as $row)
                    <div class="col-md-4 col-12" role="button">
                        <a href="{{ url("/blog/$row->seoblog") }}">
                            <div class="position-relative">
                                <img src="{{ ImageUtils::getImageThumb($row->gambarblog) }}" class="rounded" style="height: 250px; width: 100%; object-fit: cover;"/>
                                <div class="position-absolute bottom-0 end-0 p-2">
                                    <div class="text-end"><span class="badge text-bg-primary">{{ IDateTime::formatDate($row->created_at) }}</span></div>
                                </div>
                            </div>
                            <div class="d-flex flex-column text-start mt-2">
                                <h5 class="mt-1 text-justify">{{ Str::limit($row->judulblog, 100) }}</h5>
                            </div>
                        </a>
                    </div>
                @endforeach

                {{ $dataKegiatan->links() }}
            </div>
        </div>
    </section>
</div>
