<?php

namespace App\Livewire\Admin\Laporan;

use App\Models\PemeriksaanModel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Url;
use Illuminate\Support\Str;
use stdClass;

class GrafikPemeriksaan extends Component
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
        return view('livewire.admin.laporan.' . $this->pageName)
        ->layout('layouts.admin')
        ->title($this->pageTitle);
    }
}
