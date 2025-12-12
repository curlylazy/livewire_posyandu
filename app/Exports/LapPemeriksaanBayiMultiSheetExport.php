<?php

namespace App\Exports;

use App\Models\PemeriksaanModel;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class LapPemeriksaanBayiMultiSheetExport implements WithMultipleSheets
{
    protected $dataPemeriksaan;
    protected $kategori_periksa;
    protected $tahun;

    public function __construct($dataArr)
    {
        $this->readDataArray($dataArr);
    }

    private function readDataArray($dataArr)
    {
        $data = json_decode($dataArr, true);
        $this->kategori_periksa = $data['kategori_periksa'];
        $this->tahun = $data['tahun'];
    }

    private function readData($bulan)
    {
        $rowsData = PemeriksaanModel::joinTable()
                ->searchByMonthYear($bulan, $this->tahun)
                ->searchByKategoriPeriksa($this->kategori_periksa)
                ->get();

        return $rowsData;
    }

    public function sheets(): array
    {
        $sheets = [];

        for ($i = 1; $i <= 12; $i++) {
            $bulan = Carbon::create()->month($i)->format('m');
            $bulanName = Carbon::create()->month($i)->format('F');
            $data = $this->readData($bulan);
            $sheets[] = new SheetLapPemeriksaanBayiView($data, $bulanName, $this->tahun, $this->kategori_periksa);
        }

        return $sheets;
    }
}
