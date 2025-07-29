<?php

namespace App\Livewire\Admin\Laporan;

use App\Exports\RekapPemeriksaanBayiExport;
use App\Lib\Rekap;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Maatwebsite\Excel\Facades\Excel;

class RekapBayi extends Component
{
    use WithPagination;

    public $pageTitle = "Rekap Pemeriksaan Bayi";
    public $pageName = "rekap_bayi";

    #[Url]
    public $katakunci = "", $tahun = "";

    public function mount()
    {
        $this->tahun = (empty($this->tahun)) ? date("Y") : $this->tahun;
    }

    public function readData()
    {
        $rowsData = Rekap::pemeriksaanBayi($this->tahun);
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
                new RekapPemeriksaanBayiExport(json_encode($array)),
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
