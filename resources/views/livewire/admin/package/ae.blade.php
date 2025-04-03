<div>

    @script
        <script>
            $wire.on('confirm-delete', (e) => {
                Swal.fire({
                    title: 'Hapus Data',
                    text: `Hapus data ${e.nama} dari package, lanjutkan ?`,
                    icon: "question",
                    showCancelButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $wire.hapusActivity(e.nama);
                    }
                });
            });
        </script>
    @endscript


    <x-partials.loader />
    <x-partials.flashmsg />
    <x-partials.package.modalactivity :dataActivity="$dataActivity" />
    <x-slot:bc>
        <li class="breadcrumb-item"><a href="{{ url("/admin") }}" class="text-decoration-none" wire:navigate><span>Home</span></a></li>
        <li class="breadcrumb-item"><a href="{{ url("/admin/$pageName") }}" class="text-decoration-none" wire:navigate><span>{{ $pageTitle }}</span></a></li>
        @if($isEdit)
            <li class="breadcrumb-item"><span>Edit</span></li>
            <li class="breadcrumb-item active"><span>{{ $form->namapackage }}</span></li>
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
                            <input type="text" class="form-control" id="namapackage" wire:model='form.namapackage'>
                            <label for="namapackage">Nama Package</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="harga" wire:model='form.harga' x-mask:dynamic="$money($input)">
                            <label for="harga">Harga</label>
                        </div>
                    </div>

                    <div class="col-md-12 mt-4">
                        <h5>Daftar Activity</h5>
                        <button class="btn btn-sm btn-secondary mb-3" type="button" wire:click='showActivity'><i class="fas fa-plus"></i> Add</button>
                        <div class="d-flex flex-row flex-wrap gap-2">
                            @foreach ($dataPackageActivityInclude as $data)
                                <div class="border rounded-pill p-2 d-flex gap-2">
                                    <div>{{ $data }}</div>
                                    <button class="btn btn-sm btn-text" type="button" wire:click='$dispatch("confirm-delete", { nama: "{{ $data }}"})'><i class="fas fa-trash text-danger"></i></button>
                                </div>
                            @endforeach
                        </div>
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
