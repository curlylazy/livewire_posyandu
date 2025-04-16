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
                            <input type="text" class="form-control" id="nik" wire:model='form.nik'>
                            <label for="nik">NIK</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="namapasien" wire:model='form.namapasien'>
                            <label for="namapasien">Nama Pasien</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <select type="text" class="form-control" id="kategoripasien" wire:model='form.kategoripasien'>
                                <option value="">Pilih Kategori Pasien</option>
                                @foreach (Option::kategoriPasien() as $data)
                                    <option value="{{ $data['value'] }}">{{ $data['name'] }}</option>
                                @endforeach
                            </select>
                            <label for="kategoripasien">Kategori Pasien</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control date" id="form.tgl_lahir" wire:model='form.tgl_lahir' placeholder="">
                            <label for="form.tgl_lahir">Tanggal Lahir</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="nama_suami" wire:model='form.nama_suami'>
                            <label for="nama_suami">Nama Suami</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="alamat" wire:model='form.alamat'>
                            <label for="alamat">Alamat</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="nohp" wire:model='form.nohp'>
                            <label for="nohp">No Handphone</label>
                        </div>
                    </div>

                    {{-- *** tampil jika pasien adalah ibu hamil --}}
                    <div class="col-md-4" x-show="$wire.form->kategoripasien == 'bumil'">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="hamil_ke" wire:model='form.hamil_ke' x-mask:dynamic="$money($input)">
                            <label for="hamil_ke">Hamil Ke ?</label>
                        </div>
                    </div>
                    <div class="col-md-4" x-show="$wire.form->kategoripasien == 'bumil'">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="bulan_ke" wire:model='form.bulan_ke'>
                            <label for="bulan_ke">Bulan Ke ?</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="bb" wire:model='form.bb' x-mask:dynamic="$money($input)">
                            <label for="bb">Berat Badan</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="lila" wire:model='form.lila' x-mask:dynamic="$money($input)">
                            <label for="lila">Lingkar Lengan</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="tekanan_darah" wire:model='form.tekanan_darah' x-mask:dynamic="$money($input)">
                            <label for="tekanan_darah">Tekanan Darah</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="border rounded-3 p-2">
                            <h6 class="fw-normal">Status Aktif Pasien</h6>
                            <div class="d-flex gap-2">
                                <div>
                                    <input type="radio" class="btn-check" name="status" value="1" id="status_ya" autocomplete="off" wire:model="form.status">
                                    <label class="btn" for="status_ya">Aktif</label>
                                </div>
                                <div>
                                    <input type="radio" class="btn-check" name="status" value="0" id="status_tidak" autocomplete="off" wire:model="form.status">
                                    <label class="btn" for="status_tidak">Tidak Aktif</label>
                                </div>
                            </div>
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
