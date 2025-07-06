<?php

namespace App\Exports;

use App\Lib\Rekap;
use App\Lib\Utils;
use App\Models\PasienModel;
use App\Models\PemeriksaanModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class PemeriksaanBayiExport implements FromView, WithEvents, ShouldAutoSize, WithProperties, WithDrawings
{
    protected $tahun;
    protected $page_title;
    protected $kodepasien;
    protected $kategoriperiksa = "bayi";

    public function __construct($dataArr)
    {
        $this->readDataArray($dataArr);
    }

    private function readDataArray($dataArr)
    {
        $data = json_decode($dataArr, true);
        $this->kodepasien = $data['kodepasien'];
        $this->page_title = "KARTU BANTU PEMERIKSAAN BAYI, BALITA DAN APRAS";
    }

    public function properties(): array
    {
        return [
            'creator'        => config('app.webcreator'),
            'lastModifiedBy' => config('app.webcreator'),
            'title'          => $this->page_title,
            'description'    => 'kartu bantu pemeriksaan bayi, balita dan apras',
            'subject'        => $this->page_title,
            'keywords'       => 'pemeriksaan ibu hamil, ibu nifas',
            'category'       => 'Report',
            'manager'        => '--',
            'company'        => config('app.webcreator'),
            'zoomScale'      => 80,
        ];
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo Posyandu');
        $drawing->setPath(public_path('logo.png')); // Logo di folder public/images
        $drawing->setHeight(80); // Atur ukuran
        $drawing->setCoordinates('A1'); // Logo muncul di cell A1
        $drawing->setOffsetX(10);
        $drawing->setOffsetY(10);

         // *** watermark
        $drawingWaterMark = new Drawing();
        $drawingWaterMark->setName('Watermark');
        $drawingWaterMark->setDescription('Watermark Laporan');
        $drawingWaterMark->setPath(public_path('logo_opacity_2.png')); // Path ke gambar
        $drawingWaterMark->setHeight(700); // Tinggi gambar dalam pixel
        $drawingWaterMark->setCoordinates('F30'); // Letak gambar (sel awal)

        return [
            $drawing,
            $drawingWaterMark
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Atur wrap text untuk kolom B dan C, misalnya sampai baris 100
                // $event->sheet->getDelegate()->getStyle('A20:B20')->getAlignment()->setWrapText(true);

                $sheet = $event->sheet->getDelegate();
                $dimension = $sheet->calculateWorksheetDimension();

                // Terapkan wrap text ke seluruh range
                $sheet->getStyle($dimension)
                    ->getAlignment()
                    ->setWrapText(true);

                $event->sheet->getDelegate()
                    ->getStyle($event->sheet->getDelegate()->calculateWorksheetDimension())
                    ->getAlignment()
                    ->setVertical(Alignment::VERTICAL_CENTER);

                $borderStyle = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_MEDIUM,
                            'color' => ['rgb' => 'FFFFFF'], // Warna putih
                        ],
                    ],
                ];

                $sheet->getStyle('A9:AC12')->applyFromArray($borderStyle);

            },
        ];
    }

    public function view(): View
    {
        $dataPasien = PasienModel::selectCustom()->find($this->kodepasien);
        $dataRows = PemeriksaanModel::joinTable()
                    ->searchByKodePasien($this->kodepasien)
                    ->searchByKategoriPeriksa($this->kategoriperiksa)
                    ->get();

        return view('exports.pemeriksaan_bayi_per_pasien', [
            'page_title' => $this->page_title,
            'dataPasien' => $dataPasien,
            'dataRows' => $dataRows,
        ]);
    }
}

