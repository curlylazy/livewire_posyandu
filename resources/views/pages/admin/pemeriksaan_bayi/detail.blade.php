<?php

use App\Lib\IDateTime;
use App\Lib\Pemeriksaan;
use App\Livewire\Forms\PasienForm;
use App\Livewire\Forms\PemeriksaanForm;
use App\Models\PasienModel;
use App\Models\PemeriksaanModel;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;

new class extends Component
{
    public $pageTitle = "Pemeriksaan";
    public $pageName = "pemeriksaan";
    public $dirView = "pemeriksaan_bayi";
    public $isEdit = false;
    public $id = "";
    public $kategori_periksa = "bayi";

    public PemeriksaanForm $form;

    public function mount($id = null)
    {
        $this->id = $id;
        $this->setTitle();
    }

    public function setTitle()
    {
        $this->pageTitle = "Pemeriksaan Bayi";
    }

    public function readData()
    {
        $data = PemeriksaanModel::joinTable()->find($this->id);
        return $data;
    }

    public function readDataHasilPenimbangan($data)
    {
        $previousPemeriksaan = PemeriksaanModel::searchByKategoriPeriksa($this->kategori_periksa)
            ->orderBy('created_at', 'desc')
            ->where('created_at', '<', $data->created_at)
            ->first();

        // *** umur yang digunakan adalah saat pemeriksaan
        $umurBayi = IDateTime::dateDiff($data->tgl_lahir, $data->tgl_periksa);

        $bbSaatIni = $data->periksa_bb;
        $bbSebelumnya = ($previousPemeriksaan) ? $previousPemeriksaan->periksa_bb : 0;
        $isBBNaik = Pemeriksaan::isBeratBadanNaik($bbSaatIni, $bbSebelumnya);
        $kesimpulanBB = Pemeriksaan::kesimpulanBeratBadan($umurBayi, $data->periksa_bb);
        $kesimpulanTB = Pemeriksaan::kesimpulanTinggiBadan($umurBayi, $data->periksa_tinggi_badan);
        $kesimpulanBBGizi = Pemeriksaan::kesimpulanBBGizi($umurBayi, $data->periksa_bb);
        $kesimpulanLK = Pemeriksaan::kesimpulanLingkarKepala($umurBayi, $data->periksa_lingkar_kepala, $data->jk);
        $kesimpulanLilaGizi = Pemeriksaan::kesimpulanLilaGizi($data->periksa_lila);

        $data = (object) [
            'isBBNaik' => $isBBNaik,
            'kesimpulanBB' => $kesimpulanBB,
            'kesimpulanTB' => $kesimpulanTB,
            'kesimpulanBBGizi' => $kesimpulanBBGizi,
            'kesimpulanLK' => $kesimpulanLK,
            'kesimpulanLilaGizi' => $kesimpulanLilaGizi,
        ];

        return $data;
    }

    public function render()
    {
        $data = $this->readData();

        return $this->view([
                "dataRow" => $data,
                "dataHasilPenimbangan" => $this->readDataHasilPenimbangan($data),
            ])
            ->layout('layouts.admin')
            ->title($this->pageTitle." - ".config('app.webname'));
    }
};

?>

{{-- *** Views --}}
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
                            <div class="fw-bold">{{ $dataRow->nik }}</div>
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

                {{-- *** sudah menggunakan hasil langsung bukan lewat rumus --}}
                {{-- <div class="col-12">
                    <h5 class="mt-4">Hasil Penimbangan Pengukuran</h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex flex-md-row flex-column">
                            <div class="flex-grow-1">Kesimpulan Hasil Penimbangan BB Bayi/Balita dibandingkan bulan sebelumnya :</div>
                            <div class="fw-bold">{{ $dataHasilPenimbangan->isBBNaik }}</div>
                        </li>
                        <li class="list-group-item d-flex flex-md-row flex-column">
                            <div class="flex-grow-1">Kesimpulan Hasil Pengukuran BB/Umur 0-5 tahun :</div>
                            <div class="fw-bold">{{ $dataHasilPenimbangan->kesimpulanBB }}</div>
                        </li>
                        <li class="list-group-item d-flex flex-md-row flex-column">
                            <div class="flex-grow-1">Kesimpulan Hasil Pengukuran PB/TB/Umur 0-5 tahun :</div>
                            <div class="fw-bold">{{ $dataHasilPenimbangan->kesimpulanTB }}</div>
                        </li>
                        <li class="list-group-item d-flex flex-md-row flex-column">
                            <div class="flex-grow-1">Kesimpulan Hasil Pengukuran BB/PB atau BB/TB :</div>
                            <div class="fw-bold">{{ $dataHasilPenimbangan->kesimpulanBBGizi }}</div>
                        </li>
                        <li class="list-group-item d-flex flex-md-row flex-column">
                            <div class="flex-grow-1">Kesimpulan Hasil Pengukuran Lingkar Kepala 0-5 tahun :</div>
                            <div class="fw-bold">{{ $dataHasilPenimbangan->kesimpulanLK }}</div>
                        </li>
                        <li class="list-group-item d-flex flex-md-row flex-column">
                            <div class="flex-grow-1">Hasil Lingkar Lengan Atas Bayi/Balita :</div>
                            <div class="fw-bold">{{ $dataHasilPenimbangan->kesimpulanLilaGizi }}</div>
                        </li>
                    </ul>
                </div> --}}

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

                <div class="col-12">
                    <h5 class="mt-4">Bayi/Balita mendapatkan : </h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex flex-md-row flex-column">
                            <div class="flex-grow-1">ASI Ekslusif ? :</div>
                            <div class="fw-bold">{{ Option::getYaAtauTidak($dataRow->is_asi_ekslusif) }}</div>
                        </li>
                        <li class="list-group-item d-flex flex-md-row flex-column">
                            <div class="flex-grow-1">MP ASI (Komposisi, jenis sesuai umur) :</div>
                            <div class="fw-bold">{{ Option::getYaAtauTidak($dataRow->is_mpasi_sesuai) }}</div>
                        </li>
                        <li class="list-group-item d-flex flex-md-row flex-column">
                            <div class="flex-grow-1">Imunisasi (Lengkap sesuai umur) ? :</div>
                            <div class="fw-bold">{{ Option::getYaAtauTidak($dataRow->is_imunisasi_lengkap) }}</div>
                        </li>

                        @if($dataRow->is_imunisasi_lengkap == 1)
                            <li class="list-group-item flex-column">
                                <div class="flex-grow-1">Jenis Imunisasi yang diberikan :</div>
                                <div class="fw-bold">{{ $dataRow->jenis_imunisasi }}</div>
                            </li>
                        @endif

                        <li class="list-group-item d-flex flex-md-row flex-column">
                            <div class="flex-grow-1">Vitamin A ?</div>
                            <div class="fw-bold">{{ Option::getYaAtauTidak($dataRow->is_beri_vit_a) }}</div>
                        </li>
                        <li class="list-group-item d-flex flex-md-row flex-column">
                            <div class="flex-grow-1">Obat Cacing ?</div>
                            <div class="fw-bold">{{ Option::getYaAtauTidak($dataRow->is_beri_obat_cacing) }}</div>
                        </li>
                        <li class="list-group-item d-flex flex-md-row flex-column">
                            <div class="flex-grow-1">MT Pangan Lokal Untuk Pemulihan (Konsumsi patuh) ?</div>
                            <div class="fw-bold">{{ Option::getYaAtauTidak($dataRow->is_mt_pangan_lokal_pemulihan) }}</div>
                        </li>

                        @if($dataRow->is_imunisasi_lengkap == 1)
                            <li class="list-group-item d-flex flex-md-row flex-column">
                                <div class="flex-grow-1">Porsi yang Diberikan :</div>
                                <div class="fw-bold">{{ $dataRow->mt_pangan_lokal_porsi }}</div>
                            </li>
                        @endif
                    </ul>
                </div>

                <div class="col-12">
                    <h5 class="mt-4">Lainnya : </h5>
                    <ul class="list-group">
                        <li class="list-group-item flex-column">
                            <div class="flex-grow-1">Edukasi/Konseling :</div>
                            <div class="fw-bold">{{ $dataRow->edukasi }}</div>
                        </li>
                        <li class="list-group-item d-flex flex-md-row flex-column">
                            <div class="flex-grow-1">Ada Gejala Sakit ?</div>
                            <div class="fw-bold">{{ Option::getYaAtauTidak($dataRow->is_gejala_sakit) }}</div>
                        </li>

                        @if($dataRow->is_gejala_sakit == 1)
                            <li class="list-group-item d-flex flex-md-row flex-column">
                                <div class="flex-grow-1">Keterangan Gejala Sakit :</div>
                                <div class="fw-bold">{{ $dataRow->gejala_sakit_keterangan }}</div>
                            </li>
                        @endif
                    </ul>
                </div>

                <div class="col-12">
                    <h5 class="mt-4">Hasil Penimbangan Pengukuran : </h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex flex-md-row flex-column">
                            <div class="flex-grow-1">Berat Badan Naik ? :</div>
                            <div class="fw-bold">{{ Option::getYaAtauTidak($dataRow->kesimpulan_berat_badan_naik) }}</div>
                        </li>
                        <li class="list-group-item d-flex flex-md-row flex-column">
                            <div class="flex-grow-1">Kesimpulan Berat Badan :</div>
                            <div class="fw-bold">{{ Option::getOptionName(Option::$optNameKesimpulanBB, $dataRow->kesimpulan_berat_badan) }}</div>
                        </li>
                        <li class="list-group-item d-flex flex-md-row flex-column">
                            <div class="flex-grow-1">Kesimpulan Tinggi Badan :</div>
                            <div class="fw-bold">{{ Option::getOptionName(Option::$optNameKesimpulanTinggiBadan, $dataRow->kesimpulan_tinggi_badan) }}</div>
                        </li>
                        <li class="list-group-item d-flex flex-md-row flex-column">
                            <div class="flex-grow-1">Kesimpulan Lingkar Kepala :</div>
                            <div class="fw-bold">{{ Option::getOptionName(Option::$optNameKesimpulanLila, $dataRow->kesimpulan_lingkar_kepala) }}</div>
                        </li>
                        <li class="list-group-item d-flex flex-md-row flex-column">
                            <div class="flex-grow-1">Kesimpulan Gizi BB :</div>
                            <div class="fw-bold">{{ Option::getOptionName(Option::$optNameKesimpulanGiziBB, $dataRow->kesimpulan_gizi_bb) }}</div>
                        </li>
                        <li class="list-group-item d-flex flex-md-row flex-column">
                            <div class="flex-grow-1">Kesimpulan Gizi Lila :</div>
                            <div class="fw-bold">{{ Option::getOptionName(Option::$optNameKesimpulanGiziLila, $dataRow->kesimpulan_gizi_lila) }}</div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="d-flex mt-3 gap-2">
                <a href="{{ url("admin/$pageName/bayi") }}" class="btn btn-secondary" type="button" wire:navigate><i class="fas fa-arrow-left"></i></a>
            </div>

        </div>
    </div>

</div>
