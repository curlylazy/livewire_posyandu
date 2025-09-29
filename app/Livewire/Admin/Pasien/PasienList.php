<?php

namespace App\Livewire\Admin\Pasien;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\PasienModel;
use App\Models\PosyanduModel;

class PasienList extends Component
{
    use WithPagination;

    public $pageTitle = "Pasien";
    public $pageName = "pasien";
    public $selectedKode = "";
    public $selectedNama = "";

    #[Url]
    public $katakunci = "", $kategoriumur = "", $status = 1, $kategoripasien = "", $kodeibu = "", $kodeposyandu = "";
    public $namaibu = "";

    public function mount()
    {

    }

    public function readData()
    {
        $data = PasienModel::selectCustom()
                ->search($this->katakunci)
                ->searchByKategoriUmur($this->kategoriumur)
                ->searchByPosyandu($this->kodeposyandu)
                ->searchByKategoriPasien($this->kategoripasien)
                ->searchByIbu($this->kodeibu)
                ->latest('tbl_pasien.created_at')
                ->searchByStatus($this->status)
                ->paginate(20);

        return $data;
    }

    public function readDataPosyandu()
    {
        $res = PosyanduModel::pluck('namaposyandu', 'kodeposyandu');
        return $res;
    }

    public function selectData($data)
    {
        $this->selectedKode = $data['kodepasien'];
        $this->selectedNama = $data['namapasien'];
        $this->dispatch('open-modal', namamodal: "modalPilihData");
    }

    public function hapus($id)
    {
        $data = PasienModel::find($id);
        $namadata = $data->namapasien;
        $data->delete();

        session()->flash('success', "berhasil hapus data $namadata");
        $this->readData();
    }

    public function commitPage()
    {
        $this->resetPage();
    }

    // *** extra : action on modal
    public function modalSelectPasien($data)
    {
        $data = json_decode($data);
        $this->kodeibu = $data->kodepasien;
        $this->namaibu = $data->namapasien;
        $this->dispatch('close-modal', namamodal : 'modalPasien');
    }

    public function render()
    {
        return view('livewire.admin.' . $this->pageName . '.list', [
            "dataRow" => $this->readData(),
            "dataPosyandu" => $this->readDataPosyandu(),
        ])
        ->layout('components.layouts.admin')
        ->title($this->pageTitle." - ".config('app.webname'));
    }
}
