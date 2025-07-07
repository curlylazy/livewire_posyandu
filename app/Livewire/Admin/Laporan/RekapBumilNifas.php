<?php

namespace App\Livewire\Admin\Laporan;

use App\Exports\LapPemeriksaanMultiSheetExport;
use App\Exports\RekapPemeriksaanBumilNifasExport;
use App\Lib\AkunTansi;
use App\Lib\Rekap;
use App\Models\PemeriksaanModel;
use Illuminate\Support\Str;
use App\Models\PesanHDModel;
use Illuminate\Support\Arr;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\On;
use Maatwebsite\Excel\Facades\Excel;

class RekapBumilNifas extends Component
{
    use WithPagination;

    public $pageTitle = "Rekap Bumil dan Nifas";
    public $pageName = "rekap_bumil_nifas";

    #[Url]
    public $katakunci = "", $tahun = "";

    public function mount()
    {
        $this->tahun = (empty($this->tahun)) ? date("Y") : $this->tahun;
    }

    public function readData()
    {
        $rowsData = Rekap::pemeriksaanBumilNifas($this->tahun);
        return $rowsData;
    }

    public function onClickExportExcel()
    {
        try
        {
            $array = [
                'tahun' => $this->tahun,
            ];

            $namafile = "Rekap Pemeriksaan $this->pageTitle Tahun $this->tahun.xlsx";
            return Excel::download(
                new RekapPemeriksaanBumilNifasExport(json_encode($array)),
                $namafile,
            );

        } catch (\Exception $e) {
            $this->dispatch('notif', message: "gagal cetak laporan excel : ".$e->getMessage(), icon: "error");
            return;
        }
    }

    public function render()
    {
        return view("livewire.admin.laporan.".$this->pageName, [
            "dataRow" => $this->readData(),
        ])
        ->layout('components.layouts.admin')
        ->title($this->pageTitle);
    }
}
