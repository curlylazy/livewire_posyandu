<div>

    @assets
        <!-- Include Jodit CSS Styling -->
        {{-- <link rel="stylesheet" href="//unpkg.com/jodit@4.1.16/es2021/jodit.min.css"> --}}
        {{-- <script src="//unpkg.com/jodit@4.1.16/es2021/jodit.min.js"></script> --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jodit/4.1.16/es2015/jodit.fat.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jodit/4.1.16/es2018/jodit.fat.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @endassets

    @script
        <script>

            document.addEventListener('livewire:navigated', (event) => {
                flatpickr(".date", { dateFormat: "Y-m-d", disableMobile: "true" });
            });

            $wire.on('confirm-delete-gambar-activity', (e) => {
                Swal.fire({
                    title: 'Hapus Gambar',
                    text: `Item yang kamu pilih gambarnya akan dihapus, lanjutkan ?`,
                    icon: "question",
                    showCancelButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $wire.hapusGambarActivity(e.kode);
                    }
                });
            });

            $wire.on('confirm-delete-gambar', (e) => {
                Swal.fire({
                    title: 'Hapus Gambar',
                    text: `Item yang kamu pilih gambarnya akan dihapus, lanjutkan ?`,
                    icon: "question",
                    showCancelButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $wire.hapusGambar();
                    }
                });
            });
        </script>
    @endscript

    <x-partials.loader />
    <x-partials.flashmsg />
    <x-partials.activity.modaladdgambar :form="$form" />
    <x-slot:bc>
        <li class="breadcrumb-item"><a href="{{ url("/admin") }}" class="text-decoration-none" wire:navigate><span>Home</span></a></li>
        <li class="breadcrumb-item"><a href="{{ url("/admin/$pageName") }}" class="text-decoration-none" wire:navigate><span>{{ $pageTitle }}</span></a></li>
        @if($isEdit)
            <li class="breadcrumb-item"><span>Edit</span></li>
            <li class="breadcrumb-item active"><span>{{ $form->namaactivity }}</span></li>
        @else
            <li class="breadcrumb-item active"><span>Tambah</span></li>
        @endif
    </x-slot>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">{{ $pageTitle }}</h5>

            <form wire:submit="save">

                <div class="row g-2">

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="namaactivity" wire:model='form.namaactivity'>
                            <label for="namaactivity">Nama</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <textarea type="text" class="form-control" id="keterangansingkat" wire:model='form.keterangansingkat' style="height: 100px;"></textarea>
                            <label for="keterangansingkat">Keterangan Singkat</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="nourut" wire:model='form.nourut'>
                            <label for="nourut">No Urut</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <livewire:jodit-text-editor wire:model="form.keterangan" />
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="form.gambaractivityFile" class="form-label">Gambar</label>
                        <input class="form-control" type="file" id="form.gambaractivityFile" wire:model='form.gambaractivityFile'>
                        @if ($form->gambaractivityFile)
                            <img src="{{ $form->gambaractivityFile->temporaryUrl() }}" style="width: 500px; height: 500px; object-fit: cover;" class="rounded mt-2">
                        @elseif(!empty($form->gambaractivity))
                            <div class="d-inline-flex flex-column gap-2">
                                <a href="{{ ImageUtils::getImage($form->gambaractivity) }}" target="_blank">
                                    <img src="{{ ImageUtils::getImageThumb($form->gambaractivity) }}" style="width: 500px; height: 500px; object-fit: cover;" class="rounded mt-2">
                                </a>
                                <button type="button" class="btn btn-sm btn-danger text-white" wire:click='$dispatch("confirm-delete-gambar")'><i class="fas fa-trash"></i> Hapus Gambar</button>
                            </div>
                        @endif
                    </div>

                    @if($isEdit)
                        <hr class="mt-3"/>
                        <div class="d-flex justify-content-between align-items-center mb-3 mt-3">
                            <h5 class="card-title mb-0">Galeri Activity</h5>
                            <button class="btn btn-sm btn-outline-primary" type="button" wire:click='$dispatch("open-modal", { namamodal: "modalActivityAddGambar" })'><i class="fas fa-plus"></i> Add Gambar</button>
                        </div>

                        <div class="row">
                            @foreach ($dataGaleriActivity as $data)
                                <div class="col-12 col-md-2 position-relative">
                                    <img class="rounded-3" src="{{ ImageUtils::getImage($data->gambargaleriactivity) }}" style="width: 100%; height: 200px; object-fit: cover;" />
                                    <div class="position-absolute bottom-0 start-0">
                                        <div class="d-flex p-2 gap-2">
                                            <button type="button" class="btn btn-sm btn-danger text-white" wire:click='$dispatch("confirm-delete-gambar-activity", { kode: "{{ $data->kodegaleriactivity }}" })'><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="d-flex mt-3 gap-2">
                    <a href="{{ url("admin/$pageName") }}" class="btn btn-secondary" type="button" wire:navigate><i class="fas fa-arrow-left"></i></a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </div>

            </form>

        </div>
    </div>

</div>
