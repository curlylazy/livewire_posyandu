<?php

namespace App\Livewire\Admin\Laporan;

use App\Exports\PemeriksaanBayiExport;
use App\Exports\PemeriksaanBumilNifasPerPasienExport;
use App\Lib\GetString;
use App\Models\PasienModel;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\PemeriksaanModel;
use Livewire\Attributes\On;
use Maatwebsite\Excel\Facades\Excel;

class PemeriksaanRiwayatBayi extends Component
{
    use WithPagination;

    public $pageTitle = "Pemeriksaan Riwayat Bayi";
    public $pageName = "pemeriksaan";

    #[Url]
    public $namapasien = "", $kodebayi = "";

    public $judulModalPasien = "";
    public $kategoriumurArr = [];
    public $jk = "";

    public $selectedKode = "";
    public $selectedNama = "";
    public $kodepasien = "";
    public $kategori_periksa = "bayi";

    public $listAnak = [];


    public function mount()
    {
        $this->pageTitle = "Riwayat Pemeriksaan Bayi";
        $this->listAnak = collect();
    }

    public function readData()
    {
        $data = PemeriksaanModel::searchByKodePasien($this->kodepasien)
            ->searchByKategoriPeriksa($this->kategori_periksa)
            ->joinTable()
            ->latest('tbl_pemeriksaan.tgl_periksa')
            ->paginate(10);

        return $data;
    }

    public function selectData($data)
    {
        $this->selectedKode = $data['kodepemeriksaan'];
        $this->selectedNama = $data['namapasien'];
        $this->dispatch('open-modal', namamodal: "modalPilihData");
    }

    // *** extra
    public function onClickOpenModalPasien()
    {
        $this->judulModalPasien = "Daftar Bayi";
        $this->kategoriumurArr = ["'Balita'", "'Anak-anak'"];
        $this->dispatch('open-modal', namamodal : 'modalPasien');
    }

    public function modalSelectPasien($data)
    {
        $data = json_decode($data);
        $this->kodepasien = $data->kodepasien;
        $this->namapasien = $data->namapasien;

        $this->dispatch('close-modal', namamodal : 'modalPasien');
        $this->readData();
    }

    public function onClickExportToExcel()
    {
        if(empty($this->kodepasien)) {
            $this->dispatch('notif', message: "pilih pasien dulu ya, baru bisa export excelnya!", icon: "error");
            return;
        }

        $array = [
            "kodepasien" => $this->kodepasien,
        ];

        $namafile = "Laporan Pemeriksaan ".GetString::getJudulByKategoriPeriksa($this->kategori_periksa)." Per Pasien.xlsx";
        return Excel::download(new PemeriksaanBayiExport(json_encode($array)), $namafile);
    }

    public function render()
    {
        return view('livewire.admin.laporan.riwayat_bayi', [
            "dataRow" => $this->readData(),
        ])
        ->layout('components.layouts.admin')
        ->title($this->pageTitle." - ".config('app.webname'));
    }
}
