<?php

namespace App\Livewire\Admin;

use App\Models\PasienModel;
use App\Models\PemeriksaanModel;
use Illuminate\Support\Str;
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
        $dataPasien = PasienModel::jumlahPerKategori()->get();
        $data = collect();
        $data->push((object) ["kategori" => "Balita", "total" => $dataPasien->firstWhere('kategori', 'Balita')->total ?? 0]);
        $data->push((object) ["kategori" => "Anak-anak", "total" => $dataPasien->firstWhere('kategori', 'Anak-anak')->total ?? 0]);
        $data->push((object) ["kategori" => "Remaja", "total" => $dataPasien->firstWhere('kategori', 'Remaja')->total ?? 0]);
        $data->push((object) ["kategori" => "Dewasa", "total" => $dataPasien->firstWhere('kategori', 'Dewasa')->total ?? 0]);
        $data->push((object) ["kategori" => "Lansia", "total" => $dataPasien->firstWhere('kategori', 'Lansia')->total ?? 0]);

        return $data;
    }

    public function readPemeriksaanTerakhir()
    {
        $dataArr = collect();
        $dataRows = PemeriksaanModel::with(['pasien'])->limit(5)->latest()->get();
        foreach($dataRows as $data)
        {
            $url = "";
            if($data->kategori_periksa == "bayi") {
                $url = url("admin/pemeriksaan/bayi/detail/$data->kodepemeriksaan");
            }

            elseif($data->kategori_periksa == "bumil" || $data->kategori_periksa == "nifas") {
                $url = url("admin/pemeriksaan/bumilnifas/detail/$data->kodepemeriksaan");
            }

            $dataArr->push((object) [
                "namapasien" => $data->pasien->namapasien,
                "kategori_periksa" => Str::title($data->kategori_periksa),
                "url" => $url
            ]);
        }

        return $dataArr;
    }

    public function render()
    {
        return view('pages.admin.dashboard')
            ->with([
                "dataJumlahPerKategori" => $this->readJumlahPerKategori(),
                "dataPeriksa" => $this->readPemeriksaanTerakhir(),
            ])
            ->layout('layouts.admin')
            ->title($this->pageTitle." - ".config('app.webname'));
    }
}
