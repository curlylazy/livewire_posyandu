<?php

namespace App\Livewire\Admin\Laporan;

use App\Exports\LapPemeriksaanMultiSheetExport;
use App\Lib\AkunTansi;
use App\Models\PemeriksaanModel;
use Illuminate\Support\Str;
use App\Models\PesanHDModel;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Maatwebsite\Excel\Facades\Excel;
use stdClass;

class GrafikPemeriksaan extends Component
{

    public $pageTitle = "Grafik Pemeriksaan";
    public $pageName = "grafik_pemeriksaan";

    #[Url]
    public $tahun = "";

    public function mount()
    {
        $this->tahun = (empty($this->tahun)) ? date("Y") : $this->tahun;
    }

    public function readData()
    {
        $rows = PemeriksaanModel::select('kategori_periksa', DB::raw('count(*) as total'))
                    ->whereYear('tgl_periksa', $this->tahun)
                    ->groupBy('kategori_periksa')
                    ->get();

        $valuesPeriksaBayi = [];
        $valuesPeriksaBumil = [];
        $valuesPeriksaNifas = [];

        foreach ($rows as $row) {
            if($row->kategori_periksa == 'bayi') {
                $valuesPeriksaBayi[] = $row->total;
            }

            else if($row->kategori_periksa == 'bumil') {
                $valuesPeriksaBumil[] = $row->total;
            }

            else if($row->kategori_periksa == 'nifas') {
                $valuesPeriksaNifas[] = $row->total;
            }
        }

        $res = new stdClass();
        $res->valuesPeriksaBayi = $valuesPeriksaBayi;
        $res->valuesPeriksaBumil = $valuesPeriksaBumil;
        $res->valuesPeriksaNifas = $valuesPeriksaNifas;

        return $res;
    }

    public function render()
    {
        return view('livewire.admin.laporan.' . $this->pageName, [
            "dataChart" => $this->readData(),
        ])
        ->layout('components.layouts.admin')
        ->title($this->pageTitle);
    }
}
