<div>

    @script
        <script>

            $wire.on('selected-modal-open', (e) => {
                $wire.dispatch('open-modal', { namamodal: "modalPilihData" });
            });

            $wire.on('confirm-delete', (e) => {
                Swal.fire({
                    title: 'Hapus Data',
                    text: `Hapus data ${e.nama} dari sistem, lanjutkan ?`,
                    icon: "question",
                    showCancelButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $wire.hapus(e.kode);
                    }
                });
            });
        </script>
    @endscript

    <x-partials.loader />
    <x-partials.flashmsg />
    <x-slot:bc>
        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="text-decoration-none"><span>Home</span></a></li>
        <li class="breadcrumb-item active"><span>{{ $pageTitle }}</span></li>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">{{ $pageTitle }}</h5>

            <div class="mb-3">
                <a class="btn btn-outline-secondary" type="button" href="{{ url("admin/") }}"><i class="fas fa-arrow-left"></i></a>
                <a class="btn btn-outline-primary" role="button" href="{{ url("admin/$pageName/add") }}" wire:navigate><i class="fas fa-plus"></i> Tambah</a>
                <input type="text" class="form-control mt-2" placeholder="masukkan kata kunci pencarian..." wire:model='katakunci' wire:keydown.enter='$commit'>
            </div>

            <div class="row g-4">
                @foreach ($dataRow as $row)
                    <div class="col-md-3 col-12" wire:click='selectData({{ $row }})' role="button">
                        <div class="position-relative">
                            <img src="{{ ImageUtils::getImageThumb($row->gambargaleri) }}" class="rounded mb-2" style="height: 250px; width: 100%; object-fit: cover;" title="{{ $row->judulgaleri }}"/>
                            <div class="position-absolute bottom-0 start-0 mb-2">
                                <div class="bg-dark text-white bg-opacity-75 m-1 p-1 rounded-1">
                                    <div class="fs-sm">{{ IDateTime::formatDate($row->created_at) }}</div>
                                    <h5>{{ Str::title(Str::limit($row->judulgaleri, 50)) }}</h5>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="d-flex flex-column">
                            <img src="{{ ImageUtils::getImage($row->gambargaleri) }}" class="rounded mb-2" style="height: 250px; width: 100%; object-fit: cover;"/>
                            <div class="fs-sm mb-0">{{ IDateTime::formatDate($row->created_at) }}</div>
                            <h5 class="mt-0">{{ $row->judulgaleri }}</h5>
                        </div> --}}
                    </div>
                @endforeach
            </div>

            {{-- *** Modal Selected --}}
            <x-partials.modalselected>
                <x-slot:pageTitle>{{ $pageTitle }}</x-slot>
                <x-slot:selectedNama>{{ $selectedNama }}</x-slot>
                <div class="d-grid gap-2">
                    <a class="btn btn-lg btn-outline-primary" href="{{ url("admin/$pageName/edit/$selectedKode") }}" role="button"><i class="fas fa-edit"></i> Edit</a>
                    <button type="button" class="btn btn-lg btn-outline-danger" data-coreui-dismiss="modal" wire:click='$dispatch("confirm-delete", { kode: "{{ $selectedKode }}", nama: "{{ $selectedNama }}" })'><i class="fas fa-trash"></i> Hapus</button>
                    <button type="button" class="btn btn-lg btn-outline-secondary" data-coreui-dismiss="modal"><i class="fas fa-close"></i> Batal</button>
                </div>
            </x-partials.modalselected>

            {{ $dataRow->links() }}
        </div>
    </div>

</div>
