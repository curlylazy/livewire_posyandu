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
    public $katakunci = "", $kategori_periksa = "", $bulan = "", $tahun = "";

    public function mount()
    {
        $this->pageTitle = ($this->kategori_periksa == "bumil") ? "Pemeriksaan Ibu Hamil" : "Pemeriksaan Nifas";
        $this->bulan = date('m');
        $this->tahun = date('Y');
    }

    public function readData()
    {
        $data = PemeriksaanModel::search($this->katakunci)
                ->joinTable()
                ->searchByMonthYear(month : $this->bulan, year: $this->tahun)
                ->searchByKategoriPeriksa($this->kategori_periksa)
                ->orderBy('tbl_pemeriksaan.tgl_periksa', 'ASC')
                ->paginate(20);

        return $data;
    }

    public function getSetPeriode($data = "")
    {
        if(empty($data)) {
            $this->dispatch('open-modal', namamodal: "modalYearMonthPicker");
            return;
        }

        $this->bulan = json_decode($data, true)['bulan'];
        $this->tahun = json_decode($data, true)['tahun'];
        $this->readData();
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
        ->layout('layouts.admin')
        ->title($this->pageTitle." - ".config('app.webname'));
    }
}
