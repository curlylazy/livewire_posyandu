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

            $wire.on('confirm-save', (e) => {
                Swal.fire({
                    title: 'Simpan Data',
                    text: `Lanjutkan simpan data pemeriksaan ?`,
                    icon: "question",
                    showCancelButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $wire.save();
                    }
                });
            });

        </script>
    @endscript

    <livewire:partial.modal-add-bayi :kodepasien="$form->kodepasien" :namapasien="$form->namapasien" />
    <livewire:partial.modal-bayi :kodepasien="$form->kodepasien" :namapasien="$form->namapasien" />

    <livewire:partial.modal-add-pasien
        :kategori_periksa="$kategori_periksa"
        :judulModal="$judulModalPasien"
        :pilihanAdd="$pulihanModalPasien"
        :kodeibu="$form->kodepasien"
        @saved="modalSelectPasien($event.detail.data)"
    />

    <livewire:partial.modal-pasien
        :judulModal="$judulModalPasien"
        :kategoriumur="$kategoriumur"
        :keteranganModal="$keteranganModal"
        :kodeibu="$form->kodepasien"
        :jk="$jk"
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

            <form>

                <div class="row g-2">

                    @if(!$isEdit)
                        <div class="col-12">
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary" wire:click='onClickOpenModalAddPasien("bumilnifas")'><i class="fas fa-female"></i> Tambah Pasien</button>
                                <button type="button" x-show="$wire.kategori_periksa == 'nifas'" x-cloak class="btn btn-primary" wire:click='onClickOpenModalAddPasien("bayi")'><i class="fas fa-baby"></i> Tambah Bayi</button>
                            </div>
                        </div>
                    @endif

                    {{-- *** pilih pasien bumil --}}
                    <div class="col-12 col-md-12">
                        <div class="input-group">
                            <div class="form-floating">
                                <input type="text" class="form-control pe-none" id="form.namapasien" wire:model='form.namapasien' placeholder="" readonly>
                                <label for="form.namapasien">{{ ($kategori_periksa == "bumil") ? "Nama Pasien" : "Nama Ibu" }}</label>
                            </div>
                            <button x-show='$wire.form.kodepasien != ""' x-cloak class="btn btn-outline-secondary" type="button" data-coreui-target="#modalPasien" data-coreui-toggle="modal"><i class="fas fa-info"></i></button>
                            <button class="btn btn-outline-secondary" type="button" wire:click='onClickOpenModalPasien("bumilnifas")'><i class="fas fa-search"></i></button>
                        </div>
                    </div>

                    {{-- *** pilih bayi --}}
                    <div class="col-12 col-md-12" x-show="$wire.kategori_periksa == 'nifas'" x-cloak>
                        <div class="input-group">
                            <div class="form-floating">
                                <input type="text" class="form-control pe-none" id="form.namabayi" wire:model='form.namabayi' placeholder="" readonly>
                                <label for="form.namabayi">Nama Bayi</label>
                            </div>
                            <button x-show='$wire.form.kodebayi != ""' class="btn btn-outline-secondary" type="button"><i class="fas fa-info"></i></button>
                            <button class="btn btn-outline-secondary" type="button" wire:click='onClickOpenModalPasien("bayi")'><i class="fas fa-search"></i></button>
                        </div>
                    </div>

                    <div class="col-12 col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control date" id="form.tgl_periksa" wire:model='form.tgl_periksa' placeholder="">
                            <label for="form.tgl_periksa">Tanggal Periksa</label>
                        </div>
                    </div>
                </div>

                {{-- ** Nifas --}}
                <div class="row mt-1 g-2" x-show="$wire.kategori_periksa == 'nifas'">
                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="form.periksa_bb_bayi" wire:model='form.periksa_bb_bayi' placeholder="" x-mask:dynamic="$money($input)">
                            <label for="form.periksa_bb_bayi">Berat Badan Bayi</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="form.periksa_tinggi_badan" wire:model='form.periksa_tinggi_badan' placeholder="" x-mask:dynamic="$money($input)">
                            <label for="form.periksa_tinggi_badan">Tinggi Badan Bayi</label>
                        </div>
                    </div>
                </div>

                <div class="row mt-1 g-2" x-show="$wire.kategori_periksa == 'bumil'" x-cloak>
                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="form.periksa_hamil_ke" wire:model='form.periksa_hamil_ke' placeholder="" x-mask:dynamic="$money($input)">
                            <label for="form.periksa_hamil_ke">Hamil Ke</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="form.periksa_minggu_ke" wire:model='form.periksa_minggu_ke' placeholder="" x-mask:dynamic="$money($input)">
                            <label for="form.periksa_minggu_ke">Minggu Ke</label>
                        </div>
                    </div>
                </div>

                {{-- ** Hasil Penimbangan/Pengukuran/Pemeriksaan --}}
                <div class="row mt-1 g-2" x-show="$wire.kategori_periksa == 'bumil' || $wire.kategori_periksa == 'nifas'">
                    <div class="col-12">
                        <hr />
                        <h6>Hasil Penimbangan/Pengukuran/Pemeriksaan</h6>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="form.periksa_bb" wire:model='form.periksa_bb' placeholder="" x-mask:dynamic="$money($input)">
                            <label for="form.periksa_bb">Berat Badan</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <select type="text" class="form-control" id="form.is_sesuai_kurva_bb" wire:model='form.is_sesuai_kurva_bb'>
                                <option value="0">Tidak Sesuai</option>
                                <option value="1">Sesuai</option>
                            </select>
                            <label for="form.is_sesuai_kurva_bb">Sesuai Kurva Buku KIA</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-12">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="form.periksa_lila" wire:model='form.periksa_lila' placeholder="">
                            <label for="form.periksa_lila">Lingkar Lengan Atas</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="form.periksa_tekanan_darah" wire:model='form.periksa_tekanan_darah' placeholder="">
                            <label for="form.periksa_tekanan_darah">Tekanan Darah</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <select type="text" class="form-control" id="form.is_sesuai_kurva_tekanan_darah" wire:model='form.is_sesuai_kurva_tekanan_darah'>
                                <option value="0">Tidak Sesuai</option>
                                <option value="1">Sesuai</option>
                            </select>
                            <label for="form.is_sesuai_kurva_tekanan_darah">Sesuai Kurva Buku KIA</label>
                        </div>
                    </div>
                </div>

                {{-- ** Hasil Skrining TBC --}}
                <div class="row mt-1 g-2" x-show="$wire.kategori_periksa == 'bumil' || $wire.kategori_periksa == 'nifas'">
                    <div class="col-12">
                        <hr />
                        <h6>Hasil Skrining TBC</h6>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="border rounded-3 p-2">
                            <h6 class="fw-normal">Apakah pasien mengalami batuk terus menerus ?</h6>
                            <div class="d-flex gap-2">
                                <div>
                                    <input type="radio" class="btn-check" name="is_batuk" value="1" id="is_batuk_ya" autocomplete="off" wire:model="form.is_batuk">
                                    <label class="btn" for="is_batuk_ya">Iya</label>
                                </div>
                                <div>
                                    <input type="radio" class="btn-check" name="is_batuk" value="0" id="is_batuk_tidak" autocomplete="off" wire:model="form.is_batuk">
                                    <label class="btn" for="is_batuk_tidak">Tidak</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="border rounded-3 p-2">
                            <h6 class="fw-normal">Apakah pasien mengalami demam lebih dari 2 minggu ?</h6>
                            <div class="d-flex gap-2">
                                <div>
                                    <input type="radio" class="btn-check" name="is_demam" value="1" id="is_demam_ya" autocomplete="off" wire:model="form.is_demam">
                                    <label class="btn" for="is_demam_ya">Iya</label>
                                </div>
                                <div>
                                    <input type="radio" class="btn-check" name="is_demam" value="0" id="is_demam_tidak" autocomplete="off" wire:model="form.is_demam">
                                    <label class="btn" for="is_demam_tidak">Tidak</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="border rounded-3 p-2">
                            <h6 class="fw-normal">Apakah BB pasien tidak naik atau turun dalam 2 bulan berturut-turut ?</h6>
                            <div class="d-flex gap-2">
                                <div>
                                    <input type="radio" class="btn-check" name="is_bb_tidak_naik_turun" value="1" id="is_bb_tidak_naik_turun_ya" autocomplete="off" wire:model="form.is_bb_tidak_naik_turun">
                                    <label class="btn" for="is_bb_tidak_naik_turun_ya">Iya</label>
                                </div>
                                <div>
                                    <input type="radio" class="btn-check" name="is_bb_tidak_naik_turun" value="0" id="is_bb_tidak_naik_turun_tidak" autocomplete="off" wire:model="form.is_bb_tidak_naik_turun">
                                    <label class="btn" for="is_bb_tidak_naik_turun_tidak">Tidak</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="border rounded-3 p-2">
                            <h6 class="fw-normal">Apakah pasien ada kontak erat dengan pasien TBC ?</h6>
                            <div class="d-flex gap-2">
                                <div>
                                    <input type="radio" class="btn-check" name="is_kontak_pasien_tbc" value="1" id="is_kontak_pasien_tbc_ya" autocomplete="off" wire:model="form.is_kontak_pasien_tbc">
                                    <label class="btn" for="is_kontak_pasien_tbc_ya">Iya</label>
                                </div>
                                <div>
                                    <input type="radio" class="btn-check" name="is_kontak_pasien_tbc" value="0" id="is_kontak_pasien_tbc_tidak" autocomplete="off" wire:model="form.is_kontak_pasien_tbc">
                                    <label class="btn" for="is_kontak_pasien_tbc_tidak">Tidak</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pemberian TTD & MT Bumil KEK --}}
                <div class="row mt-1 g-2" x-show="$wire.kategori_periksa == 'bumil'">
                    <div class="col-12">
                        <hr />
                        <h6>Pemberian Tablet Tambah Darah (TTD) & MT Bumil Kurang Energi Kronis (KEK)</h6>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="form-floating">
                            <select type="text" class="form-control" id="form.is_beri_tablet" wire:model='form.is_beri_tablet'>
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                            <label for="form.is_beri_tablet">Apakah Diberikan Tablet ?</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6" x-bind:class="$wire.form.is_beri_tablet == 0 ? 'd-none' : ''">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="form.jml_tablet" wire:model='form.jml_tablet' placeholder="" x-mask:dynamic="$money($input)">
                            <label for="form.jml_tablet">Jumlah Tablet</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6" x-bind:class="$wire.form.is_beri_tablet == 0 ? 'd-none' : ''">
                        <div class="form-floating">
                            <select type="text" class="form-control" id="form.konsumsi_tablet" wire:model='form.konsumsi_tablet'>
                                <option value="0">Tidak Setiap Hari</option>
                                <option value="1">Setiap Hari</option>
                            </select>
                            <label for="form.konsumsi_tablet">Konsumsi Tablet Tambah Darah</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-12">
                        <div class="form-floating">
                            <select type="text" class="form-control" id="form.is_beri_mt" wire:model='form.is_beri_mt'>
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                            <label for="form.is_beri_mt">Apakah Diberikan MT Bumil KEK ?</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6" x-bind:class="$wire.form.is_beri_mt == 0 ? 'd-none' : ''">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="form.mt_bumil" wire:model='form.mt_bumil' placeholder="">
                            <label for="form.mt_bumil">Jumlah Komposisi dan Jumlah Porsi</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6" x-bind:class="$wire.form.is_beri_mt == 0 ? 'd-none' : ''">
                        <div class="form-floating">
                            <select type="text" class="form-control" id="form.konsumsi_mt_bumil" wire:model='form.konsumsi_mt_bumil'>
                                <option value="0">Tidak Setiap Hari</option>
                                <option value="1">Setiap Hari</option>
                            </select>
                            <label for="form.konsumsi_mt_bumil">Konsumsi MT Bumil KEK</label>
                        </div>
                    </div>
                </div>

                {{-- Kelas Ibu Hamil --}}
                <div class="row mt-1 g-2">
                    <div class="col-12">
                        <hr />
                        <h6>{{ $kategori_periksa == 'bumil' ? 'Kelas Ibu Hamil' : 'Edukasi' }}</h6>
                    </div>
                    <div class="col-12 col-md-6" x-show="$wire.kategori_periksa == 'bumil'">
                        <div class="form-floating">
                            <select type="text" class="form-control" id="form.is_kelas_bumil" wire:model='form.is_kelas_bumil'>
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                            <label for="form.is_kelas_bumil">Apakah Mengikuti Kelas Ibu Hamil ?</label>
                        </div>
                    </div>
                    <div class="col-12" x-bind:class="$wire.kategori_periksa == 'bumil' ? 'col-md-6' : 'col-md-12'">
                        <div class="form-floating">
                            <select type="text" class="form-control" id="form.is_rujuk" wire:model='form.is_rujuk'>
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                            <label for="form.is_rujuk">Rujuk Pustu / Puskesmas / Rumah Sakit ?</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-12" x-bind:class="$wire.form.is_kelas_bumil == 0 && $wire.kategori_periksa == 'bumil' ? 'd-none' : ''">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="form.edukasi" wire:model='form.edukasi' placeholder="">
                            <label for="form.edukasi">Edukasi yang Diberikan</label>
                        </div>
                    </div>
                </div>

                <div class="row mt-1 g-2" x-show="$wire.kategori_periksa == 'nifas'">
                    <div class="col-12">
                        <hr />
                        <h6>Pemberian Vit A, Menyusui dan KB</h6>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <select type="text" class="form-control" id="form.is_beri_vit_a" wire:model='form.is_beri_vit_a'>
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                            <label for="form.is_beri_vit_a">Apakah Memberikan Vitamin A ?</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6" x-bind:class="$wire.form.is_beri_vit_a == 0 ? 'pe-none' : ''">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="form.jml_tablet_vit_a" wire:model='form.jml_tablet_vit_a' placeholder="" x-mask:dynamic="$money($input)">
                            <label for="form.jml_tablet_vit_a">Jumlah Komposisi dan Jumlah Porsi</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="border rounded-3 p-2">
                            <h6 class="fw-normal">Apakah perlu konsumsi Vitamin A ?</h6>
                            <div class="d-flex gap-2">
                                <div>
                                    <input type="radio" class="btn-check" name="is_konsumsi_vit_a" value="1" id="is_konsumsi_vit_a_ya" autocomplete="off" wire:model="form.is_konsumsi_vit_a">
                                    <label class="btn" for="is_konsumsi_vit_a_ya">Iya</label>
                                </div>
                                <div>
                                    <input type="radio" class="btn-check" name="is_konsumsi_vit_a" value="0" id="is_konsumsi_vit_a_tidak" autocomplete="off" wire:model="form.is_konsumsi_vit_a">
                                    <label class="btn" for="is_konsumsi_vit_a_tidak">Tidak</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="border rounded-3 p-2">
                            <h6 class="fw-normal">Apakah ibu menyusui ?</h6>
                            <div class="d-flex gap-2">
                                <div>
                                    <input type="radio" class="btn-check" name="is_menyusui" value="1" id="is_menyusui_ya" autocomplete="off" wire:model="form.is_menyusui">
                                    <label class="btn" for="is_menyusui_ya">Iya</label>
                                </div>
                                <div>
                                    <input type="radio" class="btn-check" name="is_menyusui" value="0" id="is_menyusui_tidak" autocomplete="off" wire:model="form.is_menyusui">
                                    <label class="btn" for="is_menyusui_tidak">Tidak</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex mt-3 gap-2">
                    <a href="{{ url("admin/$pageName?kategori_periksa=$kategori_periksa") }}" class="btn btn-secondary" type="button" wire:navigate><i class="fas fa-arrow-left"></i></a>
                    <button type="button" class="btn btn-primary" wire:click='$dispatch("confirm-save")'><i class="fas fa-save"></i> Simpan</button>
                </div>

            </form>

        </div>
    </div>

</div>
