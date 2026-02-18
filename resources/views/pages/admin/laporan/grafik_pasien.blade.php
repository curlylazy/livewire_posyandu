<?php

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

new class extends Component
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
        return $this->view([
            "dataChart" => $this->readData(),
        ])
        ->layout('layouts.admin')
        ->title($this->pageTitle);
    }
};

?>

{{-- *** Views --}}
<div>
    <x-partials.loader />
    <x-partials.flashmsg />
    <x-slot:bc>
        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="text-decoration-none"><span>Home</span></a></li>
        <li class="breadcrumb-item active"><span>{{ $pageTitle }}</span></li>
    </x-slot>


    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">{{ $pageTitle }}</h5>

            <div class="mb-2">
                <a class="btn btn-outline-secondary" type="button" href="{{ url('/admin') }}" wire:navigate><i class="fas fa-arrow-left"></i></a>
                <a class="btn btn-outline-secondary" type="button" wire:click='readData'><i class="fas fa-search"></i> Cari</a>
            </div>

            <div class="row">
                <div class="col-12">
                    <canvas id="myChart"></canvas>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- *** External Asset --}}
@assets
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endassets

{{-- *** Script --}}
<script>
    const ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($wire.dataChart.labels),
            datasets: [{
                label: 'Kategori Pasien', // Label untuk dataset pertama
                data: @json($wire.dataChart.values), // Data untuk dataset pertama
                backgroundColor: 'rgba(255, 99, 132, 0.6)', // Warna latar belakang
                borderColor: 'rgba(255, 99, 132, 1)', // Warna border
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
