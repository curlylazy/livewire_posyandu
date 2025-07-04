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

    <livewire:partial.modal-add-pasien
        :kategori_periksa="$subPage"
        :judulModal="$judulModalPasien"
        :pilihanAdd="$pilihanModalPasien"
        :kodeibu="$form->kodeibu"
        @saved="modalSelectPasien($event.detail.data)"
    />

    <livewire:partial.modal-pasien
        :judulModal="$judulModalPasien"
        :kategoriumur="$kategoriumur"
        :kategoriumurArr="$kategoriumurArr"
        :keteranganModal="$keteranganModal"
        :kodeibu="$form->kodeibu"
        :jk="$jk"
        @selectpasien="modalSelectPasien($event.detail.data)"
    />

    <x-partials.loader />
    <x-partials.flashmsg />
    <x-slot:bc>
        <li class="breadcrumb-item"><a href="{{ url("/admin") }}" class="text-decoration-none" wire:navigate><span>Home</span></a></li>
        <li class="breadcrumb-item"><a href="{{ url("/admin/$pageName/bumilnifas") }}" class="text-decoration-none" wire:navigate><span>{{ $pageTitle }}</span></a></li>
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
                                <button type="button" class="btn btn-primary" wire:click='onClickOpenModalAddPasien("ibu")'><i class="fas fa-female"></i> Tambah Pasien</button>
                                <button type="button" class="btn btn-primary" wire:click='onClickOpenModalAddPasien("bayi")'><i class="fas fa-baby"></i> Tambah Bayi</button>
                            </div>
                        </div>
                    @endif

                    {{-- *** pilih pasien bumil --}}
                    <div class="col-12 col-md-12">
                        <div class="input-group">
                            <div class="form-floating">
                                <input type="text" class="form-control pe-none" id="form.namaibu" wire:model='form.namaibu' placeholder="" readonly>
                                <label for="form.namaibu">Nama Ibu</label>
                            </div>
                            <button class="btn btn-outline-secondary" type="button" wire:click='onClickOpenModalPasien("ibu")'><i class="fas fa-search"></i></button>
                        </div>
                    </div>

                    {{-- *** pilih bayi --}}
                    <div class="col-12 col-md-12">
                        <div class="input-group">
                            <div class="form-floating">
                                <input type="text" class="form-control pe-none" id="form.namapasien" wire:model='form.namapasien' placeholder="" readonly>
                                <label for="form.namapasien">Nama Bayi</label>
                            </div>
                            <button class="btn btn-outline-secondary" type="button" wire:click='onClickOpenModalPasien("bayi")'><i class="fas fa-search"></i></button>
                        </div>
                    </div>

                    <div class="col-12 col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control date" id="form.tgl_periksa" wire:model='form.tgl_periksa' placeholder="">
                            <label for="form.tgl_periksa">Tanggal Periksa</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="form.periksa_bb" wire:model='form.periksa_bb' placeholder="" x-mask:dynamic="$money($input)">
                            <label for="form.periksa_bb">Berat Badan</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="form.periksa_tinggi_badan" wire:model='form.periksa_tinggi_badan' placeholder="" x-mask:dynamic="$money($input)">
                            <label for="form.periksa_tinggi_badan">Tinggi Badan</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="form.periksa_lingkar_kepala" wire:model='form.periksa_lingkar_kepala' placeholder="" x-mask:dynamic="$money($input)">
                            <label for="form.periksa_lingkar_kepala">Lingkar Kepala</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="form.periksa_lila" wire:model='form.periksa_lila' placeholder="" x-mask:dynamic="$money($input)">
                            <label for="form.periksa_lila">Lingkar Lengan Atas</label>
                        </div>
                    </div>

                    {{-- *** Skrining TBC --}}
                    <div class="row mt-1 g-2">
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

                    {{-- *** Bayi Balita Mendapatkan : --}}
                    <div class="row mt-1 g-2">
                        <div class="col-12">
                            <hr />
                            <h6>Bayi / Balita Mendapatkan</h6>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="border rounded-3 p-2">
                                <h6 class="fw-normal">ASI Eksklusif ?</h6>
                                <div class="d-flex gap-2">
                                    <div>
                                        <input type="radio" class="btn-check" name="is_asi_ekslusif" value="1" id="is_asi_ekslusif_ya" autocomplete="off" wire:model="form.is_asi_ekslusif">
                                        <label class="btn" for="is_asi_ekslusif_ya">Iya</label>
                                    </div>
                                    <div>
                                        <input type="radio" class="btn-check" name="is_asi_ekslusif" value="0" id="is_asi_ekslusif_tidak" autocomplete="off" wire:model="form.is_asi_ekslusif">
                                        <label class="btn" for="is_asi_ekslusif_tidak">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="border rounded-3 p-2">
                                <h6 class="fw-normal">MP ASI (Komposisi, jenis  sesuai umur) ?</h6>
                                <div class="d-flex gap-2">
                                    <div>
                                        <input type="radio" class="btn-check" name="is_mpasi_sesuai" value="1" id="is_mpasi_sesuai_ya" autocomplete="off" wire:model="form.is_mpasi_sesuai">
                                        <label class="btn" for="is_mpasi_sesuai_ya">Iya</label>
                                    </div>
                                    <div>
                                        <input type="radio" class="btn-check" name="is_mpasi_sesuai" value="0" id="is_mpasi_sesuai_tidak" autocomplete="off" wire:model="form.is_mpasi_sesuai">
                                        <label class="btn" for="is_mpasi_sesuai_tidak">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="border rounded-3 p-2">
                                <h6 class="fw-normal">Imunisasi (Lengkap sesuai umur) ?</h6>
                                <div class="d-flex gap-2">
                                    <div>
                                        <input type="radio" class="btn-check" name="is_imunisasi_lengkap" value="1" id="is_imunisasi_lengkap_ya" autocomplete="off" wire:model="form.is_imunisasi_lengkap">
                                        <label class="btn" for="is_imunisasi_lengkap_ya">Iya</label>
                                    </div>
                                    <div>
                                        <input type="radio" class="btn-check" name="is_imunisasi_lengkap" value="0" id="is_imunisasi_lengkap_tidak" autocomplete="off" wire:model="form.is_imunisasi_lengkap">
                                        <label class="btn" for="is_imunisasi_lengkap_tidak">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="border rounded-3 p-2">
                                <h6 class="fw-normal">Vitamin A ?</h6>
                                <div class="d-flex gap-2">
                                    <div>
                                        <input type="radio" class="btn-check" name="is_beri_vit_a" value="1" id="is_beri_vit_a_ya" autocomplete="off" wire:model="form.is_beri_vit_a">
                                        <label class="btn" for="is_beri_vit_a_ya">Iya</label>
                                    </div>
                                    <div>
                                        <input type="radio" class="btn-check" name="is_beri_vit_a" value="0" id="is_beri_vit_a_tidak" autocomplete="off" wire:model="form.is_beri_vit_a">
                                        <label class="btn" for="is_beri_vit_a_tidak">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12">
                            <div class="border rounded-3 p-2">
                                <h6 class="fw-normal">Obat Cacing ?</h6>
                                <div class="d-flex gap-2">
                                    <div>
                                        <input type="radio" class="btn-check" name="is_beri_obat_cacing" value="1" id="is_beri_obat_cacing_ya" autocomplete="off" wire:model="form.is_beri_obat_cacing">
                                        <label class="btn" for="is_beri_obat_cacing_ya">Iya</label>
                                    </div>
                                    <div>
                                        <input type="radio" class="btn-check" name="is_beri_obat_cacing" value="0" id="is_beri_obat_cacing_tidak" autocomplete="off" wire:model="form.is_beri_obat_cacing">
                                        <label class="btn" for="is_beri_obat_cacing_tidak">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12">
                            <div class="border rounded-3 p-2">
                                <h6 class="fw-normal">MT Pangan Lokal Untuk Pemulihan (Konsumsi patuh) ?</h6>
                                <div class="d-flex gap-2">
                                    <div>
                                        <input type="radio" class="btn-check" name="is_mt_pangan_lokal_pemulihan" value="1" id="is_mt_pangan_lokal_pemulihan_ya" autocomplete="off" wire:model="form.is_mt_pangan_lokal_pemulihan">
                                        <label class="btn" for="is_mt_pangan_lokal_pemulihan_ya">Iya</label>
                                    </div>
                                    <div>
                                        <input type="radio" class="btn-check" name="is_mt_pangan_lokal_pemulihan" value="0" id="is_mt_pangan_lokal_pemulihan_tidak" autocomplete="off" wire:model="form.is_mt_pangan_lokal_pemulihan">
                                        <label class="btn" for="is_mt_pangan_lokal_pemulihan_tidak">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12" x-cloak x-bind:class="$wire.form.is_mt_pangan_lokal_pemulihan == 0 ? 'd-none' : ''">
                            <div class="form-floating">
                                <input class="form-control" id="form.mt_pangan_lokal_porsi" wire:model='form.mt_pangan_lokal_porsi' placeholder="">
                                <label for="form.mt_pangan_lokal_porsi">Porsi yang Diberikan</label>
                            </div>
                        </div>

                        <div class="col-12 col-md-12">
                            <div class="border rounded-3 p-2">
                                <h6 class="fw-normal">Ada Gejala Sakit ?</h6>
                                <div class="d-flex gap-2">
                                    <div>
                                        <input type="radio" class="btn-check" name="is_gejala_sakit" value="1" id="is_gejala_sakit_ya" autocomplete="off" wire:model="form.is_gejala_sakit">
                                        <label class="btn" for="is_gejala_sakit_ya">Iya</label>
                                    </div>
                                    <div>
                                        <input type="radio" class="btn-check" name="is_gejala_sakit" value="0" id="is_gejala_sakit_tidak" autocomplete="off" wire:model="form.is_gejala_sakit">
                                        <label class="btn" for="is_gejala_sakit_tidak">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12" x-cloak x-bind:class="$wire.form.is_gejala_sakit == 0 ? 'd-none' : ''">
                            <div class="form-floating">
                                <input class="form-control" id="form.gejala_sakit_keterangan" wire:model='form.gejala_sakit_keterangan' placeholder="">
                                <label for="form.gejala_sakit_keterangan">Keterangan Gejala Sakit</label>
                            </div>
                        </div>

                        <div class="col-12 col-md-12">
                            <div class="form-floating">
                                <textarea class="form-control" id="form.edukasi" wire:model='form.edukasi' placeholder="" style="height: 100px"></textarea>
                                <label for="form.edukasi">Edukasi / Konseling (Jika memberikan MP-ASI kaya protein hewani disebutkan)</label>
                            </div>
                        </div>

                        <div class="col-12 col-md-12">
                            <div class="border rounded-3 p-2">
                                <h6 class="fw-normal">Rujuk Puskesmas ?</h6>
                                <div class="d-flex gap-2">
                                    <div>
                                        <input type="radio" class="btn-check" name="is_rujuk" value="1" id="is_rujuk_ya" autocomplete="off" wire:model="form.is_rujuk">
                                        <label class="btn" for="is_rujuk_ya">Iya</label>
                                    </div>
                                    <div>
                                        <input type="radio" class="btn-check" name="is_rujuk" value="0" id="is_rujuk_tidak" autocomplete="off" wire:model="form.is_rujuk">
                                        <label class="btn" for="is_rujuk_tidak">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex mt-3 gap-2">
                    <a href="{{ url("admin/$pageName/$subPage") }}" class="btn btn-secondary" type="button" wire:navigate><i class="fas fa-arrow-left"></i></a>
                    <button type="button" class="btn btn-primary" wire:click='$dispatch("confirm-save")'><i class="fas fa-save"></i> Simpan</button>
                </div>

            </form>

        </div>
    </div>

</div>
