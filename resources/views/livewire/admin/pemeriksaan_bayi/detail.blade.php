<div>

    <x-partials.loader />
    <x-partials.flashmsg />
    <x-slot:bc>
        <li class="breadcrumb-item"><a href="{{ url("/admin") }}" class="text-decoration-none" wire:navigate><span>Home</span></a></li>
        <li class="breadcrumb-item"><a href="{{ url("/admin/$pageName") }}" class="text-decoration-none" wire:navigate><span>{{ $pageTitle }}</span></a></li>
        <li class="breadcrumb-item"><span>Detail</span></li>
        <li class="breadcrumb-item active"><span>{{ $form->namapasien }}</span></li>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-1">{{ $pageTitle }}</h5>
            <h6 class="mt-0 fw-normal">Periode {{ IDateTime::formatDate($dataRow->tgl_periksa) }}</h6>
            <hr />

            <div class="row">
                <div class="col-12">
                    <h5>Data Pasien</h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex flex-md-row flex-column">
                            <div class="flex-grow-1">NIK :</div>
                            <div class="fw-bold">{{ $dataRow->nik ?? "--"}}</div>
                        </li>
                        <li class="list-group-item d-flex flex-md-row flex-column">
                            <div class="flex-grow-1">Nama Pasien :</div>
                            <div class="fw-bold">{{ $dataRow->namapasien }}</div>
                        </li>
                        <li class="list-group-item d-flex flex-md-row flex-column">
                            <div class="flex-grow-1">Nama Ibu :</div>
                            <div class="fw-bold">{{ $dataRow->namaibu }}</div>
                        </li>
                        <li class="list-group-item d-flex flex-md-row flex-column">
                            <div class="flex-grow-1">Nama Ayah :</div>
                            <div class="fw-bold">{{ $dataRow->namaayah ?? "--"}}</div>
                        </li>
                        <li class="list-group-item d-flex  flex-md-row flex-column">
                            <div class="flex-grow-1">Tanggal Lahir / Umur :</div>
                            <div class="fw-bold">{{ IDateTime::formatDate($dataRow->tgl_lahir_pasien) }} / {{ IDateTime::dateDiff($dataRow->tgl_lahir_pasien) }} Tahun</div>
                        </li>
                        <li class="list-group-item d-flex  flex-md-row flex-column">
                            <div class="flex-grow-1">Alamat :</div>
                            <div class="fw-bold">{{ $dataRow->alamat }}</div>
                        </li>
                    </ul>
                </div>

                <div class="col-12">
                    <h5 class="mt-4">Info Pemeriksaan</h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex flex-md-row flex-column">
                            <div class="flex-grow-1">Tanggal Pemeriksaan :</div>
                            <div class="fw-bold">{{ IDateTime::formatDate($dataRow->tgl_periksa) }}</div>
                        </li>
                        <li class="list-group-item d-flex  flex-md-row flex-column">
                            <div class="flex-grow-1">Umur :</div>
                            <div class="fw-bold">{{ $dataRow->hamil_ke }} / {{ $dataRow->minggu_ke }}</div>
                        </li>
                    </ul>
                </div>

                <div class="col-12">
                    <h5 class="mt-4">Hasil Penimbangan/Pengukuran/Pemeriksaan</h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex flex-md-row flex-column">
                            <div class="flex-grow-1">Berat Badan</div>
                            <div class="fw-bold">{{ $dataRow->periksa_bb }} Kg</div>
                        </li>
                        <li class="list-group-item d-flex flex-md-row flex-column">
                            <div class="flex-grow-1">Lingkar Lengan Atas (LILA) :</div>
                            <div class="fw-bold">{{ $dataRow->periksa_lila }}</div>
                        </li>
                        <li class="list-group-item d-flex flex-md-row flex-column">
                            <div class="flex-grow-1">Tinggi Badan :</div>
                            <div class="fw-bold">{{ $dataRow->periksa_tinggi_badan }}</div>
                        </li>
                        <li class="list-group-item d-flex flex-md-row flex-column">
                            <div class="flex-grow-1">Lingkar Kepala :</div>
                            <div class="fw-bold">{{ $dataRow->periksa_lingkar_kepala }}</div>
                        </li>
                    </ul>
                </div>

                <div class="col-12">
                    <h5 class="mt-4">Hasil Skrining TBC</h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex flex-md-row flex-column">
                            <div class="flex-grow-1">Apakah pasien mengalami batuk terus menerus ? :</div>
                            <div class="fw-bold">{{ Option::getYaAtauTidak($dataRow->is_batuk) }}</div>
                        </li>
                        <li class="list-group-item d-flex flex-md-row flex-column">
                            <div class="flex-grow-1">Apakah pasien mengalami demam lebih dari 2 minggu ? :</div>
                            <div class="fw-bold">{{ Option::getYaAtauTidak($dataRow->is_demam) }}</div>
                        </li>
                        <li class="list-group-item d-flex flex-md-row flex-column">
                            <div class="flex-grow-1">Apakah BB pasien tidak naik atau turun dalam 2 bulan berturut-turut ? :</div>
                            <div class="fw-bold">{{ Option::getYaAtauTidak($dataRow->is_bb_tidak_naik_turun) }}</div>
                        </li>
                        <li class="list-group-item d-flex flex-md-row flex-column">
                            <div class="flex-grow-1">Apakah pasien ada kontak erat dengan pasien TBC ? :</div>
                            <div class="fw-bold">{{ Option::getYaAtauTidak($dataRow->is_kontak_pasien_tbc) }}</div>
                        </li>
                    </ul>
                </div>


                @if($kategori_periksa == "nifas")
                    <div class="col-12">
                        <h5 class="mt-4">Pemberian Tablet Tambah Darah (TTD) & MT Bumil Kurang Energi Kronis (KEK)</h5>
                        <ul class="list-group">
                            <li class="list-group-item d-flex flex-md-row flex-column">
                                <div class="flex-grow-1">Apakah diberikan Vitamin A :</div>
                                <div class="fw-bold">{{ Option::getYaAtauTidak($dataRow->is_beri_vit_a) }} / {{ $dataRow->jml_tablet_vit_a }}</div>
                            </li>
                            <li class="list-group-item d-flex flex-md-row flex-column">
                                <div class="flex-grow-1">Apakah Ibu Sedang Menyusui :</div>
                                <div class="fw-bold">{{ Option::getYaAtauTidak($dataRow->is_menyusui) }}</div>
                            </li>
                            <li class="list-group-item d-flex flex-md-row flex-column">
                                <div class="flex-grow-1">Mengikuti KB Pasca Persalinan :</div>
                                <div class="fw-bold">{{ Option::getYaAtauTidak($dataRow->is_kb) }}</div>
                            </li>
                        </ul>
                    </div>
                @endif

                <div class="col-12">
                    <h5 class="mt-4">{{ ($kategori_periksa == "bumil") ? 'Kelas Ibu Hamil' : 'Edukasi' }}</h5>
                    <ul class="list-group">

                        @if($kategori_periksa == "bumil")
                            <li class="list-group-item d-flex flex-md-row flex-column">
                                <div class="flex-grow-1">Apakah diberikan Edukasi Ibu Hamil :</div>
                                <div class="fw-bold">{{ Option::getYaAtauTidak($dataRow->is_kelas_bumil) }}</div>
                            </li>
                        @endif

                        <li class="list-group-item d-flex flex-md-row flex-column">
                            <div class="flex-grow-1">Edukasi yang diberikan :</div>
                            <div class="fw-bold">{{ $dataRow->edukasi }}</div>
                        </li>
                        <li class="list-group-item d-flex flex-md-row flex-column">
                            <div class="flex-grow-1">Rujuk Pustu/Puskesmas/Rumah Sakit :</div>
                            <div class="fw-bold">{{ Option::getYaAtauTidak($dataRow->is_rujuk) }}</div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="d-flex mt-3 gap-2">
                <a href="{{ url("admin/$pageName?kategori_periksa=$kategori_periksa") }}" class="btn btn-secondary" type="button" wire:navigate><i class="fas fa-arrow-left"></i></a>
            </div>

        </div>
    </div>

</div>
