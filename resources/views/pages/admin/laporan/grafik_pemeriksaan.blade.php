<?php

use App\Models\PemeriksaanModel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Url;
use Illuminate\Support\Str;

new class extends Component
{
    public $pageTitle = "Grafik Pemeriksaan";
    public $pageName = "grafik_pemeriksaan";
    public $tahun = "";

    public function mount()
    {
        $this->readData();
    }

    public function readData()
    {
        $rows = PemeriksaanModel::select('kategori_periksa', DB::raw('count(*) as total'))
                    ->whereYear('tgl_periksa', $this->tahun)
                    ->groupBy('kategori_periksa')
                    ->get();

        $categories = collect([
            ['kategori_periksa' => 'bayi', 'total' => 0],
            ['kategori_periksa' => 'bumil', 'total' => 0],
            ['kategori_periksa' => 'nifas', 'total' => 0],
        ]);

        $result = $categories->map(function ($row) use ($rows) {
            $found = $rows->firstWhere('kategori_periksa', $row['kategori_periksa']);
            return [
                'kategori_periksa' =>  $row['kategori_periksa'],
                'total' => $found ? $found->total : 0
            ];
        });

        $labels = [];
        $values = [];

        foreach ($result as $row) {
            $labels[] = Str::title($row['kategori_periksa']);
            $values[] = $row['total'];
        }

        $res = new stdClass();
        $res->labels = $labels;
        $res->values = $values;

        $this->dispatch('update-chart', labels: $labels, values: $values, tahun: $this->tahun);
    }

    public function render()
    {
        return $this->view()
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

            <div class="row g-2 mb-3">
                <div class="col-12">
                    <div class="form-floating">
                        <select class="form-select" id="tahun" wire:model='tahun' aria-label="tahun pemeriksaan" wire:change='readData'>
                            <option value="">Pilih Tahun</option>
                            @foreach (Option::tahun() as $data)
                                <option value="{{ $data['value'] }}">{{ $data['value'] }}</option>
                            @endforeach
                        </select>
                        <label for="tahun">Tahun</label>
                    </div>
                </div>
            </div>

            <div class="row" x-cloak x-show='$wire.tahun != ""'>
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
            labels: [],
            datasets: [{
                label: '', // Label untuk dataset pertama
                data: [], // Data untuk dataset pertama
                backgroundColor: 'rgba(255, 99, 132, 0.6)', // Warna latar belakang
                borderColor: 'rgba(255, 99, 132, 1)', // Warna border
                borderWidth: 1
            }]
        },
        options: {
        }
    });

    // *** update cart
    $wire.on('update-chart', (e) => {
        myChart.data.labels = e.labels;
        myChart.data.datasets[0].data = e.values;
        myChart.data.datasets[0].label = `Kategori Pemeriksaan Tahun ${e.tahun}`;
        myChart.update();
    });

</script>
