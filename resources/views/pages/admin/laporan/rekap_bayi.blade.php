<?php

use App\Exports\RekapPemeriksaanBayiExport;
use App\Lib\Rekap;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Maatwebsite\Excel\Facades\Excel;

new class extends Component
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
        return $this->view([
            "dataRow" => $this->readData(),
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
                <a class="btn btn-outline-success" type="button" wire:click='onClickExportExcel' target="_blank"><i class="fas fa-file-export"></i> Export Excel</a>
            </div>

            <form autocomplete="off">
                <div class="row g-2 mb-3">
                    <div class="col-12 col-md-12">
                        <div class="form-floating">
                            <select type="text" class="form-control" id="tahun" wire:model='tahun'>
                                <option value="">Pilih Tahun</option>
                                @foreach (Option::tahun() as $data)
                                    <option value="{{ $data['value'] }}">{{ $data['name'] }}</option>
                                @endforeach
                            </select>
                            <label for="tahun">Tahun</label>
                        </div>
                    </div>
                </div>
            </form>

            {{-- *** Large Device --}}
            <x-partials.viewlarge>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Bulan</th>
                                <th scope="col">Jml Bayi dan Anak</th>
                                <th scope="col">Bayi Datang</th>
                                <th scope="col">Apras Datang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataRow as $row)
                                <tr role="button">
                                    <td>{{ $row->periode }}</td>
                                    <td>{{ $row->jml_bayi }}</td>
                                    <td>{{ $row->jml_bayi_datang }}</td>
                                    <td>{{ $row->jml_balita_apras_datang }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-partials.viewlarge>

            {{-- *** Mobile --}}
            <x-partials.viewsmall>
                <div class="row g-2">
                    <hr />
                    @foreach ($dataRow as $row)
                        <div class="col-12 col-md-12">
                            <div class="card" role="button">
                                <div class="card-body px-2 py-2 d-flex flex-column">
                                    <div>{{ $row->periode }}</div>
                                    <div class="d-flex">
                                        <div class="flex-grow-1 fw-bold">Jml Anak/Bayi</div>
                                        <div class="text-right">{{ $row->jml_bayi }}</div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="flex-grow-1">Bayi Datang</div>
                                        <div class="text-right">{{ $row->jml_bayi_datang }}</div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="flex-grow-1">Apras Datang</div>
                                        <div class="text-right">{{ $row->jml_balita_apras_datang }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </x-partials.viewsmall>
        </div>
    </div>
</div>

{{-- *** External Asset --}}
@assets
    <script src="https://cdn.jsdelivr.net/npm/sharer.js@0.5.2/sharer.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endassets

{{-- *** Script --}}
<script>
    flatpickr(".date", { dateFormat: "Y-m-d", disableMobile: "true" });
</script>
