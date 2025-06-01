<?php

namespace App\Exports;

use App\Models\PasienModel;
use App\Models\PemeriksaanModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PemeriksaanPerPasienExport implements FromView
{
    protected $kodepasien;
    protected $kategoriperiksa;
    protected $hamil_ke;

    public function __construct($dataArr)
    {
        $this->readDataArray($dataArr);
    }

    private function readDataArray($dataArr)
    {
        $data = json_decode($dataArr, true);
        $this->kategoriperiksa = $data['kategoriperiksa'];
        $this->kodepasien = $data['kodepasien'];
        $this->hamil_ke = $data['hamil_ke'];
    }

    public function view(): View
    {
        $dataPasien = PasienModel::selectCustom()->find($this->kodepasien);
        $dataRows = PemeriksaanModel::searchByKodePasien($this->kodepasien)
                    ->searchByKategoriPeriksa($this->kategoriperiksa)
                    ->searchByHamilKe($this->hamil_ke)
                    ->get();

        $page_title = ($this->kategoriperiksa == 'bumil') ? "Pemeriksaan Ibu Hamil" : "Pemeriksaan Nifas";

        return view('exports.pemeriksaan_per_pasien', [
            'page_title' => $page_title,
            'dataRows' => $dataRows,
            'dataPasien' => $dataPasien,
        ]);
    }
}

