<?php

namespace App\Livewire\Admin;

use App\Models\ActivityModel;
use App\Models\AnggotaModel;
use App\Models\BayiModel;
use App\Models\BlogModel;
use App\Models\GaleriModel;
use App\Models\KegiatanModel;
use App\Models\PasienModel;
use App\Models\PemeriksaanModel;
use Livewire\Component;

class Dashboard extends Component
{

    public $pageTitle = "Beranda";
    public $jmlPasien = 0;
    public $jmlPeriksaBulanIni = 0;
    public $jmlPeriksaTahunIni = 0;
    public $jmlBayi = 0;

    public function mount()
    {
        $this->jmlPasien = PasienModel::count();
        $this->jmlBayi = PasienModel::selectCustom()->searchByKategoriUmur('Balita')->count();
        $this->jmlPeriksaTahunIni = PemeriksaanModel::searchByYear(date('Y'))->count();
        $this->jmlPeriksaBulanIni = PemeriksaanModel::searchByMonthYear(date('m'), date('Y'))->count();
    }

    public function readJumlahPerKategori()
    {
        $data = PasienModel::jumlahPerKategori()->get();
        return $data;
    }

    public function render()
    {
        return view('livewire.admin.dashboard')
            ->with([
                "dataJumlahPerKategori" => $this->readJumlahPerKategori(),
            ])
            ->layout('components.layouts.admin')
            ->title($this->pageTitle." - ".config('app.webname'));
    }
}
