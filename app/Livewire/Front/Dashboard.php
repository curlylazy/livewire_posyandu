<?php

namespace App\Livewire\Front;

use App\Lib\MetaTag;
use App\Models\PasienModel;
use App\Models\PemeriksaanModel;
use Livewire\Component;

class Dashboard extends Component
{
    public $jmlPasien = 0;
    public $jmlPeriksaBulanIni = 0;
    public $jmlPeriksaTahunIni = 0;
    public $jmlBalita = 0;
    public $jmlAnakAnak = 0;
    public $jmlRemaja = 0;
    public $jmlDewasa = 0;
    public $jmlLansia = 0;

    public function mount()
    {
        $this->jmlPasien = PasienModel::count();
        $this->jmlPeriksaTahunIni = PemeriksaanModel::searchByYear(date('Y'))->count();
        $this->jmlPeriksaBulanIni = PemeriksaanModel::searchByMonthYear(date('m'), date('Y'))->count();
        $this->jmlBalita = PasienModel::selectCustom()->searchByKategoriUmur('Balita')->count();
        $this->jmlAnakAnak = PasienModel::selectCustom()->searchByKategoriUmur('Anak-anak')->count();
        $this->jmlRemaja = PasienModel::selectCustom()->searchByKategoriUmur('Remaja')->count();
        $this->jmlDewasa = PasienModel::selectCustom()->searchByKategoriUmur('Dewasa')->count();
        $this->jmlLansia = PasienModel::selectCustom()->searchByKategoriUmur('Lansia')->count();
    }

    public function readAboutUs()
    {
        $res = collect([
            (object)[
                'title' => 'Pelayanan Terpercaya',
                'description' => 'Tenaga kesehatan yang ramah dan profesional siap memberikan pelayanan terbaik untuk masyarakat.',
                'icon' => 'bi-hospital',
            ],
            (object)[
                'title' => 'Pemantauan Berkala',
                'description' => 'Kami melakukan pemeriksaan rutin seperti penimbangan, pengukuran tinggi badan, serta pemantauan gizi anak.',
                'icon' => 'bi-clipboard-data',
            ],
            (object)[
                'title' => 'Edukasi Kesehatan',
                'description' => 'Menyediakan informasi dan penyuluhan seputar gizi, imunisasi, serta pola asuh anak untuk orang tua.',
                'icon' => 'bi-book',
            ],
            (object)[
                'title' => 'Pertumbuhan & Perkembangan',
                'description' => 'Mendukung anak agar tumbuh sehat, cerdas, dan bahagia sesuai tahapan usianya.',
                'icon' => 'bi-graph-up-arrow',
            ],
        ]);

        return $res;
    }

    public function render()
    {
        // *** meta tag
        $mt = new MetaTag;
        $mt->title = config('app.tagline')." | ".config("app.webname");
        $mt->url = url('/');
        $mt->genMetaTag();

        return view('livewire.front.dashboard')
            ->with(['dataAbout' => $this->readAboutUs()])
            ->layout('components.layouts.front');
    }
}
