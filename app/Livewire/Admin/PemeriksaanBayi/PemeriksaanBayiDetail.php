<?php

namespace App\Livewire\Admin\PemeriksaanBayi;

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

class PemeriksaanBayiDetail extends Component
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

        return view('livewire.admin.' . $this->dirView . '.detail')
            ->with([
                "dataRow" => $data,
                "dataHasilPenimbangan" => $this->readDataHasilPenimbangan($data),
            ])
            ->layout('layouts.admin')
            ->title($this->pageTitle." - ".config('app.webname'));
    }
}
