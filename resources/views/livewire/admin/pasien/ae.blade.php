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

    <livewire:partial.modal-pasien
        :pilihanayahibu="$pilihanayahibu"
        :judulModal="$judulModalPasien"
        @selectpasien="modalSelectPasien($event.detail.data)"
    />

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
                    <div class="col-12 col-md-6">
                        <div class="border rounded-3 p-2">
                            <h6 class="fw-normal">Kategori Umur</h6>
                            <div class="d-flex flex-column flex-md-row gap-2">
                                <div>
                                    <input type="radio" class="btn-check" name="kategoriumur" value="Balita" id="kategoriumur_balita" autocomplete="off" wire:model="form.kategoriumur">
                                    <label class="btn" for="kategoriumur_balita">Balita</label>
                                </div>
                                <div>
                                    <input type="radio" class="btn-check" name="kategoriumur" value="Anak-anak" id="kategoriumur_anakanak" autocomplete="off" wire:model="form.kategoriumur">
                                    <label class="btn" for="kategoriumur_anakanak">Anak-anak</label>
                                </div>
                                <div>
                                    <input type="radio" class="btn-check" name="kategoriumur" value="Remaja" id="kategoriumur_remaja" autocomplete="off" wire:model="form.kategoriumur">
                                    <label class="btn" for="kategoriumur_remaja">Remaja</label>
                                </div>
                                <div>
                                    <input type="radio" class="btn-check" name="kategoriumur" value="Dewasa" id="kategoriumur_dewasa" autocomplete="off" wire:model="form.kategoriumur">
                                    <label class="btn" for="kategoriumur_dewasa">Dewasa</label>
                                </div>
                                <div>
                                    <input type="radio" class="btn-check" name="kategoriumur" value="Lansia" id="kategoriumur_lansia" autocomplete="off" wire:model="form.kategoriumur">
                                    <label class="btn" for="kategoriumur_lansia">Lansia</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="border rounded-3 p-2">
                            <h6 class="fw-normal">Jenis Kelamin</h6>
                            <div class="d-flex flex-column flex-md-row gap-2">
                                <div>
                                    <input type="radio" class="btn-check" name="jk" value="L" id="jk_lakilaki" autocomplete="off" wire:model="form.jk">
                                    <label class="btn" for="jk_lakilaki">Laki Laki</label>
                                </div>
                                <div>
                                    <input type="radio" class="btn-check" name="jk" value="P" id="jk_perempuan" autocomplete="off" wire:model="form.jk">
                                    <label class="btn" for="jk_perempuan">Perempuan</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" x-show="$wire.form.umur >= 17" x-cloak>
                        <div class="form-floating">
                            <input type="text" class="form-control" id="nik" wire:model='form.nik'>
                            <label for="nik">NIK</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="namapasien" wire:model='form.namapasien'>
                            <label for="namapasien">Nama Pasien</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control date" id="form.tgl_lahir" wire:model='form.tgl_lahir' wire:change='onChangeCekKategoriUmur' placeholder="">
                            <label for="form.tgl_lahir">Tanggal Lahir</label>
                        </div>
                    </div>

                </div>

                {{-- *** munculkan jika adalah seorang perempuan --}}
                <div class="row g-2 mt-0" x-show="$wire.form.jk == 'P' && ($wire.form.kategoriumur == 'Remaja' || $wire.form.kategoriumur == 'Dewasa')" x-cloak>
                    <div class="col-12 col-md-12">
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
                </div>

                {{-- *** tampil jika pasien adalah ibu hamil --}}
                <div class="row g-2 mt-0" x-show="$wire.form.kategoripasien == 'bumil'" x-cloak>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="hamil_ke" wire:model='form.hamil_ke' x-mask:dynamic="$money($input)">
                            <label for="hamil_ke">Hamil Ke ?</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="bulan_ke" wire:model='form.bulan_ke'>
                            <label for="bulan_ke">Bulan Ke ?</label>
                        </div>
                    </div>
                </div>

                <div class="row g-2 mt-0">
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

                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="beratbadan" wire:model='form.beratbadan' x-mask:dynamic="$money($input)">
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
                </div>

                {{-- jika sudah remaja / dewasa dan perempuan bisa tentukan siapa suaminya --}}
                <div class="row g-2 mt-0" x-show="$wire.form.kategoriumur == 'Dewasa' || $wire.form.kategoriumur == 'Remaja' || $wire.form.kategoriumur == 'Lansia'" x-cloak>
                    <div class="col-md-12">
                        <div class="input-group">
                            <div class="form-floating pe-none">
                                <input type="text" class="form-control" id="namasuami" wire:model='form.namasuami' placeholder="">
                                <label for="namasuami">Suami</label>
                            </div>
                            <button type="button" class="input-group-text" wire:click='onClickOpenModalPasien("suami")'><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>

                {{-- kategori umur : balita --}}
                <div class="row g-2 mt-0" x-show="$wire.form.kategoriumur == 'Balita' || $wire.form.kategoriumur == 'Anak-anak'" x-cloak>
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="form-floating pe-none">
                                <input type="text" class="form-control" id="namaayah" wire:model='form.namaayah' placeholder="">
                                <label for="namaayah">Ayah</label>
                            </div>
                            <button type="button" class="input-group-text" wire:click='onClickOpenModalPasien("lakilakiDewasa")'><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="form-floating pe-none">
                                <input type="text" class="form-control" id="namaibu" wire:model='form.namaibu' placeholder="">
                                <label for="namaibu">Ibu</label>
                            </div>
                            <button type="button" class="input-group-text" wire:click='onClickOpenModalPasien("perempuanDewasa")'><i class="fas fa-search"></i></button>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="anakke" wire:model='form.anakke' x-mask:dynamic="$money($input)">
                            <label for="anakke">Anakke</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="tinggibadan_lahir" wire:model='form.tinggibadan_lahir' x-mask:dynamic="$money($input)">
                            <label for="tinggibadan_lahir">Tinggi Badan Lahir</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="beratbadan_lahir" wire:model='form.beratbadan_lahir' x-mask:dynamic="$money($input)">
                            <label for="beratbadan_lahir">Berat Badan Lahir</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="form-floating">
                            <select type="text" class="form-control" id="carabersalin" wire:model='form.carabersalin'>
                                @foreach (Option::caraBersalin() as $data)
                                    <option value="{{ $data['value'] }}">{{ $data['name'] }}</option>
                                @endforeach
                            </select>
                            <label for="carabersalin">Cara Bersalin</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control date" id="form.tgl_bersalin" wire:model='form.tgl_bersalin' placeholder="">
                            <label for="form.tgl_bersalin">Tanggal Bersalin</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="form.tempatbersalin" wire:model='form.tempatbersalin' placeholder="">
                            <label for="form.tempatbersalin">Tempat Bersalin</label>
                        </div>
                    </div>
                </div>

                <div class="row g-2 mt-0">
                    <div class="col-12 col-md-12">
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
