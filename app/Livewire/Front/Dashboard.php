<?php

namespace App\Livewire\Front;

use App\Lib\MetaTag;
use App\Models\PasienModel;
use App\Models\PemeriksaanModel;
use Livewire\Component;

class Dashboard extends Component
{
    public $jmlPasien = 0;
    public $jmlBayi = 0;
    public $jmlPeriksaBulanIni = 0;
    public $jmlPeriksaTahunIni = 0;

    public function mount()
    {
        $this->jmlPasien = PasienModel::count();
        $this->jmlBayi = PasienModel::selectCustom()->searchByKategoriUmur('Balita')->count();
        $this->jmlPeriksaTahunIni = PemeriksaanModel::searchByYear(date('Y'))->count();
        $this->jmlPeriksaBulanIni = PemeriksaanModel::searchByMonthYear(date('m'), date('Y'))->count();
    }

    public function render()
    {
        // *** meta tag
        $mt = new MetaTag;
        $mt->title = config('app.tagline')." | ".config("app.webname");
        $mt->url = url('/');
        $mt->genMetaTag();

        return view('livewire.front.dashboard')
            ->with([
                "dataPackage" => $this->readDataPackages(),
                "dataActivity" => $this->readDataActivity(),
            ])
            ->layout('components.layouts.front');
    }
}
