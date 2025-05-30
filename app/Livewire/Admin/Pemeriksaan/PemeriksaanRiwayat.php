<?php

namespace App\Livewire\Admin\Pemeriksaan;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\PemeriksaanModel;
use Livewire\Attributes\On;

class PemeriksaanRiwayat extends Component
{
    use WithPagination;

    public $pageTitle = "Pemeriksaan Riwayat";
    public $pageName = "pemeriksaan";

    #[Url]
    public $kategori_periksa = "", $q_hamil_ke = 0;

    public $judulModalPasien = "";
    public $kategoriumur = "";
    public $jk = "";

    public $selectedKode = "";
    public $selectedNama = "";
    public $nik = "";
    public $namapasien = "";
    public $hamil_ke = "";


    public function mount()
    {
        if($this->kategori_periksa == "bumil"){
            $this->pageTitle = "Riwayat Pemeriksaan Ibu Hamil";
        }

        if($this->kategori_periksa == "nifas"){
            $this->pageTitle = "Riwayat Pemeriksaan Nifas";
        }
    }

    public function readData()
    {
        $data = PemeriksaanModel::searchByNIK($this->nik)
                ->select('tbl_pemeriksaan.*', 'tbl_pasien.*')
                ->joinTable()
                ->searchByKategoriPeriksa($this->kategori_periksa)
                ->latest('tbl_pemeriksaan.tgl_periksa')
                ->paginate(10);

        return $data;
    }

    public function selectData($data)
    {
        $this->selectedKode = $data['kodepemeriksaan'];
        $this->selectedNama = $data['namapasien'];
        $this->dispatch('open-modal', namamodal: "modalPilihData");
    }

    // *** extra
    public function onClickOpenModalPasien()
    {
        $this->judulModalPasien = "Daftar Ibu Hamil";
        $this->kategoriumur = "Dewasa";
        $this->jk = "P";
        $this->dispatch('open-modal', namamodal : 'modalPasien');
    }

    public function onClikSetHamilKe($hamil_ke)
    {
        $this->q_hamil_ke = $hamil_ke;
        $this->readData();
    }

    public function modalSelectPasien($data)
    {
        $data = json_decode($data);
        $this->nik = $data->nik;
        $this->namapasien = $data->namapasien;
        $this->hamil_ke = $data->hamil_ke;
        $this->q_hamil_ke = $data->hamil_ke;
        $this->dispatch('close-modal', namamodal : 'modalPasien');
        $this->readData();
    }

    public function render()
    {
        return view("livewire.admin.$this->pageName.riwayat", [
            "dataRow" => $this->readData(),
        ])
        ->layout('components.layouts.admin')
        ->title($this->pageTitle." - ".config('app.webname'));
    }
}
