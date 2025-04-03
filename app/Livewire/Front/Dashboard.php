<?php

namespace App\Livewire\Front;

use App\Lib\MetaTag;
use App\Models\ActivityModel;
use App\Models\BeritaModel;
use App\Models\GaleriModel;
use App\Models\KategoriModel;
use App\Models\KegiatanModel;
use App\Models\PackageModel;
use App\Models\PelangganModel;
use App\Models\PesanHDModel;
use App\Models\ProdukModel;
use Livewire\Component;

class Dashboard extends Component
{
    public function mount()
    {

    }

    public function readDataPackages()
    {
        $data = PackageModel::get();
        return $data;
    }

    public function readDataActivity()
    {
        $data = ActivityModel::get();
        return $data;
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
