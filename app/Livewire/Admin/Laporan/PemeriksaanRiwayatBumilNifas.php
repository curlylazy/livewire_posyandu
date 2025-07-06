<?php

namespace App\Livewire\Admin\Laporan;

use App\Exports\PemeriksaanBumilNifasPerPasienExport;
use App\Lib\GetString;
use App\Models\PasienModel;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\PemeriksaanModel;
use Livewire\Attributes\On;
use Maatwebsite\Excel\Facades\Excel;

class PemeriksaanRiwayatBumilNifas extends Component
{
    use WithPagination;

    public $pageTitle = "Pemeriksaan Riwayat";
    public $pageName = "pemeriksaan";

    // *** q mengacu pada query
    #[Url]
    public $kategori_periksa = "", $q_hamil_ke = "", $nik = "", $namapasien = "", $kodebayi = "";

    public $judulModalPasien = "";
    public $kategoriumur = "";
    public $jk = "";

    public $selectedKode = "";
    public $selectedNama = "";
    public $kodepasien = "";
    public $hamil_ke = "";

    public $listAnak = [];


    public function mount()
    {
        if($this->kategori_periksa == "bumil"){
            $this->pageTitle = "Riwayat Pemeriksaan Ibu Hamil";
        }

        if($this->kategori_periksa == "nifas"){
            $this->pageTitle = "Riwayat Pemeriksaan Nifas";
        }

        $this->listAnak = collect();
    }

    public function readData()
    {
        $data = PemeriksaanModel::searchByNIK($this->nik)
            ->searchByKategoriPeriksa($this->kategori_periksa)
            ->searchByHamilKe($this->q_hamil_ke)
            ->searchByBayi($this->kodebayi)
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
        $this->judulModalPasien = "Daftar Ibu Hamil";
        $this->kategoriumur = "Dewasa";
        $this->jk = "P";
        $this->dispatch('open-modal', namamodal : 'modalPasien');
    }

    public function onClikSetHamilKe($hamil_ke)
    {
        $this->q_hamil_ke = $hamil_ke;
        $this->readData();
    }

    public function onClikSetAnak($kodebayi)
    {
        $this->kodebayi = "";
        if(!empty($kodebayi))
        {
            $this->kodebayi = $kodebayi;
            $this->readData();
        }
    }

    public function modalSelectPasien($data)
    {
        $data = json_decode($data);
        $this->kodepasien = $data->kodepasien;
        $this->nik = $data->nik;
        $this->namapasien = $data->namapasien;

        // *** hamil ke hanya untuk bumil
        if($this->kategori_periksa == "bumil") {
            $this->hamil_ke = $data->hamil_ke;
            $this->q_hamil_ke = $data->hamil_ke;
        } elseif($this->kategori_periksa == "nifas") {
            $this->listAnak = PasienModel::searchByIbu($this->kodepasien)->get();
        }

        $this->dispatch('close-modal', namamodal : 'modalPasien');
        $this->readData();
    }

    public function onClickExportToExcel()
    {
        $array = [
            "kategoriperiksa" => $this->kategori_periksa,
            "nik" => $this->nik,
            "hamil_ke" => $this->q_hamil_ke,
            "kodebayi" => $this->kodebayi,
        ];

        if(empty($this->nik)) {
            $this->dispatch('notif', message: "pilih pasien dulu ya, baru bisa export excelnya!", icon: "error");
            return;
        }

        if($this->kategori_periksa == "nifas"){
            if(empty($this->kodebayi)) {
                $this->dispatch('notif', message: "pilih balita dulu ya, baru bisa export excelnya!", icon: "error");
                return;
            }
        }

        $namafile = "Laporan Pemeriksaan ".GetString::getJudulByKategoriPeriksa($this->kategori_periksa)." Per Pasien.xlsx";
        return Excel::download(new PemeriksaanBumilNifasPerPasienExport(json_encode($array)), $namafile);
    }

    public function render()
    {
        return view('livewire.admin.laporan.riwayat_bumil_nifas', [
            "dataRow" => $this->readData(),
        ])
        ->layout('components.layouts.admin')
        ->title($this->pageTitle." - ".config('app.webname'));
    }
}
