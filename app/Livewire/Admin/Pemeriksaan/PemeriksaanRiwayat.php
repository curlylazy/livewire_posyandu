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
    public $kategori_periksa = "";

    public $selectedKode = "";
    public $selectedNama = "";
    public $nik = "";
    public $namapasien = "";


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
                ->select('tbl_pemeriksaan.*', 'tbl_pasien.*', 'tbl_bayi.*')
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
    public function onClickPilihPasien()
    {
        $this->dispatch('open-modal', namamodal : 'modalPasien');
    }

    #[On('on-selectpasien')]
    public function selectPasien($data)
    {
        $data = json_decode($data);
        $this->nik = $data->nik;
        $this->namapasien = $data->namapasien;
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
