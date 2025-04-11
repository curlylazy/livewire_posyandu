<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class SheetLapPemeriksaanView implements FromView, WithTitle, WithColumnFormatting
{
    protected $data;
    protected $bulan;
    protected $tahun;
    protected $kategori_periksa;

    public function __construct($data, $bulan, $tahun, $kategori_periksa)
    {
        $this->data = $data;
        $this->bulan = $bulan;
        $this->tahun = $tahun;
        $this->kategori_periksa = $kategori_periksa;
    }

    public function view(): View
    {
        return view('exports.sheet_pemeriksaan', [
            'dataRows' => $this->data,
            'kategori_periksa' => $this->kategori_periksa,
            'bulan' => $this->bulan,
            'tahun' => $this->tahun,
            'page_title' => ($this->kategori_periksa == 'nifas') ? "Laporan Pemeriksaan Ibu Nifas dan Menyusui" : "Laporan Pemeriksaan Ibu Hamil",
        ]);
    }

    public function title(): string
    {
        return $this->bulan;
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_NUMBER,
        ];
    }
}
