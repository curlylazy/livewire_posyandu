<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Border;

class SheetLapPemeriksaanView implements FromView, WithTitle, WithColumnFormatting, WithEvents
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

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $range = 'A6:' . $sheet->getHighestColumn() . $sheet->getHighestRow();
                $sheet->getStyle($range)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $range = 'A5:' . $sheet->getHighestColumn() . $sheet->getHighestRow();
                $sheet->getStyle($range)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

                $drawing = new Drawing();
                $drawing->setName('Watermark');
                $drawing->setDescription('Watermark Laporan');
                $drawing->setPath(public_path('logo_opacity_2.png')); // Path ke gambar
                $drawing->setHeight(700); // Tinggi gambar dalam pixel
                $drawing->setCoordinates('F20'); // Letak gambar (sel awal)
                $drawing->setWorksheet($event->sheet->getDelegate());

                $drawing = new Drawing();
                $drawing->setName('Watermark');
                $drawing->setDescription('Watermark Laporan');
                $drawing->setPath(public_path('logo_opacity_2.png')); // Path ke gambar
                $drawing->setHeight(700); // Tinggi gambar dalam pixel
                $drawing->setCoordinates('O20'); // Letak gambar (sel awal)
                $drawing->setWorksheet($event->sheet->getDelegate());

                $drawing = new Drawing();
                $drawing->setName('Watermark');
                $drawing->setDescription('Watermark Laporan');
                $drawing->setPath(public_path('logo_opacity_2.png')); // Path ke gambar
                $drawing->setHeight(700); // Tinggi gambar dalam pixel
                $drawing->setCoordinates('X20'); // Letak gambar (sel awal)
                $drawing->setWorksheet($event->sheet->getDelegate());

                $sheet = $event->sheet->getDelegate();
                $dimension = $sheet->calculateWorksheetDimension();

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

                $sheetCol = ($this->kategori_periksa == "bumil") ? "A5:AA6" : "A5:AC6";
                $sheet->getStyle($sheetCol)->applyFromArray($borderStyle);

            },
        ];
    }


    // public function registerEvents(): array
    // {
    //     return [
    //         AfterSheet::class => function(AfterSheet $event) {
    //             $event->sheet->getDelegate()->getStyle('A6:AA6')
    //                     ->getAlignment()
    //                     ->setHorizontal(Alignment::HORIZONTAL_CENTER)
    //                     ->setVertical(Alignment::VERTICAL_CENTER);
    //         },

    //         AfterSheet::class => function(AfterSheet $event) {
    //             $drawing = new Drawing();
    //             $drawing->setName('Watermark');
    //             $drawing->setDescription('Watermark Laporan');
    //             $drawing->setPath(public_path('logo_opacity_2.png')); // Path ke gambar
    //             $drawing->setHeight(700); // Tinggi gambar dalam pixel
    //             $drawing->setCoordinates('F20'); // Letak gambar (sel awal)
    //             $drawing->setWorksheet($event->sheet->getDelegate());
    //         },
    //     ];
    // }
}
