<?php

namespace App\Livewire\Admin\Laporan;

use App\Exports\LapPemeriksaanBayiMultiSheetExport;
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

class LapPemeriksaanBayi extends Component
{
    use WithPagination;

    public $pageTitle = "Laporan Pemeriksaan Bayi";
    public $pageName = "pemeriksaan_bayi";
    public $totalKunjungan = 0;
    public $kategori_periksa = "bayi";

    public $selectedKode = "";
    public $selectedNoInvoice = "";
    public $selectedNama = "";
    public $selectedTitle = "";
    public $selectedPhone = "";
    public $selectedEmail = "";
    public $selectedUrl = "";

    #[Url]
    public $katakunci = "", $bulan = "", $tahun = "";

    public function mount()
    {
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
        try
        {
            $array = [
                'kategori_periksa' => $this->kategori_periksa,
                'katakunci' => $this->katakunci,
                'bulan' => $this->bulan,
                'tahun' => $this->tahun,
            ];

            $namafile = "Laporan Pemeriksaan $this->pageTitle Tahun $this->tahun.xlsx";
            return Excel::download(
                new LapPemeriksaanBayiMultiSheetExport(json_encode($array)),
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
