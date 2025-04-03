<div>

    @assets
        <!-- Include Jodit CSS Styling -->
        <link rel="stylesheet" href="//unpkg.com/jodit@4.1.16/es2021/jodit.min.css">
        <script src="//unpkg.com/jodit@4.1.16/es2021/jodit.min.js"></script>
    @endassets

    @script
        <script>
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
    <x-slot:bc>
        <li class="breadcrumb-item"><a href="{{ url("/admin") }}" class="text-decoration-none" wire:navigate><span>Home</span></a></li>
        <li class="breadcrumb-item"><a href="{{ url("/admin/$pageName") }}" class="text-decoration-none" wire:navigate><span>{{ $pageTitle }}</span></a></li>
        @if($isEdit)
            <li class="breadcrumb-item"><span>Edit</span></li>
            <li class="breadcrumb-item active"><span>{{ $form->judulblog }}</span></li>
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
                            <input type="text" class="form-control" id="judulblog" wire:model='form.judulblog'>
                            <label for="judulblog">Judul Blog</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <livewire:jodit-text-editor wire:model="form.isiblog" />
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="form.gambarblogFile" class="form-label">Gambar</label>
                        <input class="form-control" type="file" id="form.gambarblogFile" wire:model='form.gambarblogFile'>
                        @if ($form->gambarblogFile)
                            <img src="{{ $form->gambarblogFile->temporaryUrl() }}" style="width: 500px; height: 500px; object-fit: cover;" class="rounded mt-2">
                        @elseif(!empty($form->gambarblog))
                            <div class="d-inline-flex flex-column gap-2">
                                <a href="{{ ImageUtils::getImage($form->gambarblog) }}" target="_blank">
                                    <img src="{{ ImageUtils::getImageThumb($form->gambarblog) }}" style="width: 500px; height: 500px; object-fit: cover;" class="rounded mt-2">
                                </a>
                                <button type="button" class="btn btn-sm btn-danger text-white" wire:click='$dispatch("confirm-delete-gambar")'><i class="fas fa-trash"></i> Hapus Gambar</button>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="d-flex mt-3 gap-2">
                    <a href="{{ url("admin/$pageName") }}" class="btn btn-secondary" type="button" wire:navigate><i class="fas fa-arrow-left"></i></a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </div>

            </form>

        </div>
    </div>

</div>
