<?php

namespace App\Livewire\Front;

use App\Lib\MetaTag;
use App\Models\ActivityModel;
use App\Models\PackageModel;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class Package extends Component
{
    use WithPagination;

    public $pageName = "package";
    public $pageTitle = "Packages";
    public $packageName = "";
    public $dataActivity;

    #[Url]
    public $katakunci = "";

    public function mount()
    {
    }

    public function readData()
    {
        $data = PackageModel::get();
        return $data;
    }

    public function detailPackage($kode = "") {
        $data = PackageModel::find($kode);
        $dataActivityArr = json_decode($data->activityinclude, true);

        $this->packageName = $data->namapackage;
        $this->dataActivity = ActivityModel::whereIn('namaactivity', $dataActivityArr)->get();
    }

    public function render()
    {
        // *** meta tag
        $mt = new MetaTag;
        $mt->title = $this->pageTitle." | ".config("app.webname");
        $mt->url = url("/$this->pageName");
        $mt->description = "Experience the thrill of adventure travel with our all-inclusive packages! Explore breathtaking landscapes, enjoy adrenaline-pumping activities, and immerse yourself in nature. Book your ultimate adventure today";
        $mt->genMetaTag();

        return view("livewire.front.$this->pageName")
            ->with([
                "dataPackage" => $this->readData(),
            ])
            ->layout('components.layouts.front');
    }
}
