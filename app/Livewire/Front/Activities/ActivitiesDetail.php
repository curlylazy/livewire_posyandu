<?php

namespace App\Livewire\Front\Activities;

use App\Lib\ImageUtils;
use App\Lib\MetaTag;
use App\Models\ActivityModel;
use App\Models\GaleriActivityModel;
use Livewire\Component;

class ActivitiesDetail extends Component
{
    private $pageName = "activities";
    private $pageTitle = "Activities";

    public $id = "";
    public $kode = "";
    public $namaactivity = "";

    public function mount($id)
    {
        $this->id = $id;
    }

    public function readData()
    {
        $data = ActivityModel::searchBySeo($this->id)->first();
        $this->kode = $data->kodeactivity;
        $this->namaactivity = $data->namaactivity;
        return $data;
    }

    public function readActivityLainnya()
    {
        $data = ActivityModel::inRandomOrder()->limit(5)->get();
        return $data;
    }

    public function readDataGaleriActivity()
    {
        $data = GaleriActivityModel::searchByKodeActivity($this->kode)->get();
        return $data;
    }

    public function render()
    {
        $data = $this->readData();

        // *** meta tag
        $mt = new MetaTag;
        $mt->title = $this->namaactivity." | ".config("app.webname");
        $mt->url = url("/$this->pageName/$this->id");
        $mt->image = ImageUtils::getImageThumb($data->gambaractivity);
        $mt->description = $data->keterangansingkat;
        $mt->genMetaTag();

        return view("livewire.front.$this->pageName.detail")
            ->with([
                "dataActivity" => $data,
                "dataGaleriActivity" => $this->readDataGaleriActivity(),
                "dataActivityLainnya" => $this->readActivityLainnya(),
            ])
            ->layout('components.layouts.front');
    }
}
