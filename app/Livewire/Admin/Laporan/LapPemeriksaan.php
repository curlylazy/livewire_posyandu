<?php

namespace App\Livewire\Admin\Laporan;

use App\Exports\LapPemeriksaanMultiSheetExport;
use App\Lib\AkunTansi;
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

class LapPemeriksaan extends Component
{
    use WithPagination;

    public $pageTitle = "Laporan Pemeriksaan";
    public $pageName = "pemeriksaan";
    public $totalKunjungan = 0;

    public $selectedKode = "";
    public $selectedNoInvoice = "";
    public $selectedNama = "";
    public $selectedTitle = "";
    public $selectedPhone = "";
    public $selectedEmail = "";
    public $selectedUrl = "";

    #[Url]
    public $katakunci = "", $bulan = "", $tahun = "", $kategori_periksa = "";

    public function mount()
    {
        if($this->kategori_periksa == "bumil"){
            $this->pageTitle = "Laporan Pemeriksaan Ibu Hamil";
        }

        if($this->kategori_periksa == "nifas"){
            $this->pageTitle = "Laporan Pemeriksaan Nifas";
        }

        $this->bulan = (empty($this->bulan)) ? date("m") : $this->bulan;
        $this->tahun = (empty($this->tahun)) ? date("Y") : $this->tahun;
    }

    public function readData()
    {
        $this->totalKunjungan = 0;
        $rowsData = PemeriksaanModel::joinTable()
                ->search($this->katakunci)
                ->searchByMonthYear($this->bulan, $this->tahun)
                ->searchByKategoriPeriksa($this->kategori_periksa)
                ->get();

        foreach($rowsData as $data){
            $this->totalKunjungan++;
        }

        return $rowsData;
    }

    public function setYearMonth()
    {
        $this->dispatch('on-modalyearmonth-set-title', title: "Periode Pemeriksaan");
        $this->dispatch('on-modalyearmonth-set-tanggal', bulan: $this->bulan, tahun: $this->tahun);
        $this->dispatch('open-modal', namamodal : 'modalYearMonth');
    }

    #[On("on-select-yearmonth")]
    public function selectYearMonth($bulan, $tahun, $title = "")
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
        $this->readData();
    }

    public function onClickCetak()
    {
        $array = [
            'kategori_periksa' => $this->kategori_periksa,
            'katakunci' => $this->katakunci,
            'bulan' => $this->bulan,
            'tahun' => $this->tahun,
        ];

        $this->redirect("/cetak/$this->pageName?".Arr::query($array));
    }

    public function onClickExportExcel()
    {
        $array = [
            'kategori_periksa' => $this->kategori_periksa,
            'katakunci' => $this->katakunci,
            'bulan' => $this->bulan,
            'tahun' => $this->tahun,
        ];

        return Excel::download(
            new LapPemeriksaanMultiSheetExport(json_encode($array)),
            'laporan_multi_sheet.xlsx',
        );

    }

    public function render()
    {
        return view("livewire.admin.laporan.$this->pageName", [
            "dataRow" => $this->readData(),
        ])
        ->layout('components.layouts.admin')
        ->title($this->pageTitle);
    }
}
