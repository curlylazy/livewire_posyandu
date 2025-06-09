<?php

namespace App\Exports;

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

class PemeriksaanBumilNifasPerPasienExport implements FromView, WithEvents, ShouldAutoSize, WithProperties, WithDrawings
{
    protected $nik;
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
        $this->nik = $data['nik'];
        $this->hamil_ke = $data['hamil_ke'];
    }

    public function properties(): array
    {
        return [
            'creator'        => config('app.webcreator'),
            'lastModifiedBy' => config('app.webcreator'),
            'title'          => ($this->kategoriperiksa == 'bumil') ? "Pemeriksaan Ibu Hamil" : "Pemeriksaan Nifas",
            'description'    => 'kartu mandiri per pasien yang memudahkan untuk melihat kunjungan para ibu per periodenya',
            'subject'        => 'Pasien '.($this->kategoriperiksa == 'bumil') ? 'Ibu Hamil' : 'Ibu Nifas',
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

                $event->sheet->getDelegate()->getStyle($event->sheet->getDelegate()->calculateWorksheetDimension())
                    ->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

                $borderStyle = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_MEDIUM,
                            'color' => ['rgb' => 'FFFFFF'], // Warna putih
                        ],
                    ],
                ];
                $sheet->getStyle('A17:S21')->applyFromArray($borderStyle);
            },
        ];
    }

    public function view(): View
    {
        $dataPasien = PasienModel::selectCustom()->searchByNik($this->nik)->first();
        $dataRows = PemeriksaanModel::joinTable()
                    ->searchByNik($this->nik)
                    ->searchByKategoriPeriksa($this->kategoriperiksa)
                    ->searchByHamilKe($this->hamil_ke)
                    ->get();

        $view = ($this->kategoriperiksa == 'bumil') ? "pemeriksaan_bumil_per_pasien" : "pemeriksaan_nifas_per_pasien";
        $page_title = ($this->kategoriperiksa == 'bumil') ? "Pemeriksaan Ibu Hamil" : "Pemeriksaan Nifas";
        $dataPasien->q_hamil_ke = $this->hamil_ke;
        $dataPasien->jarakkehamilan = Utils::jarakKehamilan($this->nik, $this->hamil_ke);

        return view("exports.$view", [
            'page_title' => $page_title,
            'dataRows' => $dataRows,
            'dataPasien' => $dataPasien,
        ]);
    }
}

