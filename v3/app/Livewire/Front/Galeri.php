<?php

namespace App\Livewire\Front;

use App\Lib\MetaTag;
use App\Models\BeritaModel;
use App\Models\GaleriModel;
use App\Models\KategoriModel;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\ProdukModel;

class Galeri extends Component
{
    use WithPagination;

    public $pageTitle = "Galeri";
    public $pageName = "galeri";

    #[Url]
    public $katakunci = "";

    public function mount()
    {

    }

    public function readGaleri()
    {
        $data = GaleriModel::latest()->paginate(20);
        return $data;
    }

    private function genKeyword()
    {
        $res = collect();
        $data = GaleriModel::limit(10)->latest()->pluck('namagaleri');
        $res->push($data);
        return $res;
    }

    public function render()
    {
        // *** meta tag
        $mt = new MetaTag;
        $mt->title = "Galery | ".config('app.webname');
        $mt->url = url("/galery");
        $mt->description = "Unforgettable Moments, One Click at a Time";
        $mt->addKeywordArray($this->genKeyword());
        $mt->genMetaTag();

        return view("livewire.front.".$this->pageName, [
            "dataGaleri" => $this->readGaleri(),
        ])
        ->layout('components.layouts.front');
    }
}
