<?php

namespace App\Livewire\Admin\Pemeriksaan;

use App\Exports\PemeriksaanPerPasienExport;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\PemeriksaanModel;
use Livewire\Attributes\On;
use Maatwebsite\Excel\Facades\Excel;

class PemeriksaanRiwayat extends Component
{
    use WithPagination;

    public $pageTitle = "Pemeriksaan Riwayat";
    public $pageName = "pemeriksaan";

    // *** q mengacu pada query
    #[Url]
    public $kategori_periksa = "", $q_hamil_ke = "";

    public $judulModalPasien = "";
    public $kategoriumur = "";
    public $jk = "";

    public $selectedKode = "";
    public $selectedNama = "";
    public $kodepasien = "";
    public $nik = "";
    public $namapasien = "";
    public $hamil_ke = "";


    public function mount()
    {
        if($this->kategori_periksa == "bumil"){
            $this->pageTitle = "Riwayat Pemeriksaan Ibu Hamil";
        }

        if($this->kategori_periksa == "nifas"){
            $this->pageTitle = "Riwayat Pemeriksaan Nifas";
        }
    }

    public function readData()
    {
        $data = PemeriksaanModel::searchByNIK($this->nik)
                ->select('tbl_pemeriksaan.*', 'tbl_pasien.*')
                ->joinTable()
                ->searchByKategoriPeriksa($this->kategori_periksa)
                ->searchByHamilKe($this->q_hamil_ke)
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
        }

        $this->dispatch('close-modal', namamodal : 'modalPasien');
        $this->readData();
    }

    public function onClickExportToExcel()
    {
        $array = [
            "kategoriperiksa" => $this->kategori_periksa,
            "kodepasien" => $this->kodepasien,
            "hamil_ke" => $this->q_hamil_ke,
        ];

        $namafile = "Laporan Pemeriksaan Per Pasien.xlsx";
        return Excel::download(new PemeriksaanPerPasienExport(json_encode($array)), $namafile)->setContentDisposition('inline');
    }

    public function render()
    {
        return view("livewire.admin.$this->pageName.riwayat", [
            "dataRow" => $this->readData(),
        ])
        ->layout('components.layouts.admin')
        ->title($this->pageTitle." - ".config('app.webname'));
    }
}
