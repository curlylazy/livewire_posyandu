<div>

    @assets
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @endassets

    @script
        <script>
            document.addEventListener('livewire:navigated', (event) => {
                flatpickr(".date", { dateFormat: "Y-m-d", disableMobile: "true" });
            });
        </script>
    @endscript

    <livewire:partial.modal-pasien />

    <x-partials.loader />
    <x-partials.flashmsg />
    <x-slot:bc>
        <li class="breadcrumb-item"><a href="{{ url("/admin") }}" class="text-decoration-none" wire:navigate><span>Home</span></a></li>
        <li class="breadcrumb-item"><a href="{{ url("/admin/$pageName") }}" class="text-decoration-none" wire:navigate><span>{{ $pageTitle }}</span></a></li>
        @if($isEdit)
            <li class="breadcrumb-item"><span>Edit</span></li>
            <li class="breadcrumb-item active"><span>{{ $form->namapasien }}</span></li>
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
                            <input type="text" class="form-control" id="namabayi" wire:model='form.namabayi'>
                            <label for="namabayi">Nama Bayi</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-12">
                        <div class="input-group">
                            <div class="form-floating">
                                <input type="text" class="form-control pe-none" id="form.namapasien" wire:model='form.namapasien' placeholder="" readonly>
                                <label for="form.namapasien">Ibu</label>
                            </div>
                            <button class="btn btn-outline-secondary" type="button" data-coreui-target="#modalPasien" data-coreui-toggle="modal"><i class="fas fa-search"></i></button>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control date" id="form.tgl_lahir" wire:model='form.tgl_lahir' placeholder="">
                            <label for="form.tgl_lahir">Tanggal Lahir</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control date" id="form.tgl_bersalin" wire:model='form.tgl_bersalin' placeholder="">
                            <label for="form.tgl_bersalin">Tanggal Bersalin</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <select type="text" class="form-control" id="carabersalin" wire:model='form.carabersalin'>
                                @foreach (Option::caraBersalin() as $data)
                                    <option value="{{ $data['value'] }}">{{ $data['name'] }}</option>
                                @endforeach
                            </select>
                            <label for="carabersalin">Cara Bersalin</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="form.tempatbersalin" wire:model='form.tempatbersalin' placeholder="">
                            <label for="form.tempatbersalin">Tempat Bersalin</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-12 mt-2 mb-2">
                        <label>Jenis Kelamin</label><br />
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jk" id="jk_lakilaki" value="L" wire:model='form.jk'>
                            <label class="form-check-label" for="jk_lakilaki">Laki Laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jk" id="jk_perempuan" value="P" wire:model='form.jk'>
                            <label class="form-check-label" for="jk_perempuan">Perempuan</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="anakke" wire:model='form.anakke' x-mask:dynamic="$money($input)">
                            <label for="anakke">Anak Ke</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="tinggibadan" wire:model='form.tinggibadan' x-mask:dynamic="$money($input)">
                            <label for="tinggibadan">Tinggi Badan</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="beratbadan" wire:model='form.beratbadan' x-mask:dynamic="$money($input)">
                            <label for="beratbadan">Berat Badan</label>
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
