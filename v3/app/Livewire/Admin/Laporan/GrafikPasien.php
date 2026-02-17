<?php

namespace App\Livewire\Admin\Laporan;

use App\Exports\LapPemeriksaanMultiSheetExport;
use App\Lib\AkunTansi;
use App\Models\PasienModel;
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
use Carbon\Carbon;

class GrafikPasien extends Component
{

    public $pageTitle = "Grafik Pasien";
    public $pageName = "grafik_pasien";

    #[Url]
    public $tahun = "";

    public function mount()
    {
        $this->tahun = (empty($this->tahun)) ? date("Y") : $this->tahun;
    }

    public function readData()
    {
        $dateNow = Carbon::today()->toDateString();
        $rows = PasienModel::select(
                    DB::raw("
                        CASE
                            WHEN TIMESTAMPDIFF(YEAR, tbl_pasien.tgl_lahir, '$dateNow') <= 5 THEN 'Balita'
                            WHEN TIMESTAMPDIFF(YEAR, tbl_pasien.tgl_lahir, '$dateNow') BETWEEN 6 AND 12 THEN 'Anak-anak'
                            WHEN TIMESTAMPDIFF(YEAR, tbl_pasien.tgl_lahir, '$dateNow') BETWEEN 13 AND 17 THEN 'Remaja'
                            WHEN TIMESTAMPDIFF(YEAR, tbl_pasien.tgl_lahir, '$dateNow') BETWEEN 18 AND 59 THEN 'Dewasa'
                            ELSE 'Lansia'
                        END as kategoriumur
                    "),
                    DB::raw('count(*) as total')
                )
                ->groupBy('kategoriumur') // Grouping berdasarkan alias 'kategoriumur'
                ->get();

        $categories = collect([
            ['kategoriumur' => 'Balita', 'total' => 0],
            ['kategoriumur' => 'Anak-anak', 'total' => 0],
            ['kategoriumur' => 'Remaja', 'total' => 0],
            ['kategoriumur' => 'Dewasa', 'total' => 0],
            ['kategoriumur' => 'Lansia', 'total' => 0],
        ]);

        $result = $categories->map(function ($row) use ($rows) {
            $found = $rows->firstWhere('kategoriumur', $row['kategoriumur']);
            return [
                'kategoriumur' => $row['kategoriumur'],
                'total' => $found ? $found->total : 0
            ];
        });

        $labels = [];
        $values = [];

        foreach ($result as $row) {
            $labels[] = $row['kategoriumur'];
            $values[] = $row['total'];
        }

        $res = new stdClass();
        $res->labels = $labels;
        $res->values = $values;

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
