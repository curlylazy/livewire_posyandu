<?php

namespace App\Livewire\Admin\PemeriksaanBumilNifas;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\PemeriksaanModel;

class PemeriksaanBumilNifasList extends Component
{
    use WithPagination;

    public $pageTitle = "Pemeriksaan";
    public $pageName = "pemeriksaan";
    public $subPage = "bumilnifas";
    public $dirView = "pemeriksaan_bumilnifas";
    public $selectedKode = "";
    public $selectedNama = "";

    #[Url]
    public $katakunci = "", $kategori_periksa = "";

    public function mount()
    {
        if($this->kategori_periksa == "bumil"){
            $this->pageTitle = "Pemeriksaan Ibu Hamil";
        }

        if($this->kategori_periksa == "nifas"){
            $this->pageTitle = "Pemeriksaan Nifas";
        }
    }

    public function readData()
    {
        $data = PemeriksaanModel::search($this->katakunci)
                ->joinTable()
                ->searchByKategoriPeriksa($this->kategori_periksa)
                ->latest('tbl_pemeriksaan.tgl_periksa')
                ->paginate(20);

        return $data;
    }

    public function selectData($data)
    {
        $this->selectedKode = $data['kodepemeriksaan'];
        $this->selectedNama = $data['namapasien'];
        $this->dispatch('open-modal', namamodal: "modalPilihData");
    }

    public function hapus($id)
    {
        $data = PemeriksaanModel::find($id);
        $namadata = $data->kodepemeriksaan;
        $data->delete();

        session()->flash('success', "berhasil hapus data $namadata");
        $this->readData();
    }

    public function render()
    {
        return view('livewire.admin.' . $this->dirView . '.list', [
            "dataRow" => $this->readData(),
        ])
        ->layout('components.layouts.admin')
        ->title($this->pageTitle." - ".config('app.webname'));
    }
}
