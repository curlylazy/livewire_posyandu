<?php

namespace App\Livewire\Admin\PemeriksaanBayi;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\PemeriksaanModel;

class PemeriksaanBayiList extends Component
{
    use WithPagination;

    public $pageTitle = "Pemeriksaan Bayi";
    public $pageName = "pemeriksaan";
    public $subPage = "bayi";
    public $dirView = "pemeriksaan_bayi";
    public $selectedKode = "";
    public $selectedNama = "";

    #[Url]
    public $katakunci = "", $bulan = "", $tahun = "";

    public function mount()
    {
        $this->bulan = date('m');
        $this->tahun = date('Y');
    }

    public function readData()
    {
        $data = PemeriksaanModel::search($this->katakunci)
                ->joinTable()
                ->searchByKategoriPeriksa($this->subPage)
                ->searchByMonthYear(month : $this->bulan, year: $this->tahun)
                ->latest('tbl_pemeriksaan.tgl_periksa')
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
        ->layout('components.layouts.admin')
        ->title($this->pageTitle." - ".config('app.webname'));
    }
}
