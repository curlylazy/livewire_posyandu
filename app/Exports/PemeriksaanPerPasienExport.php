<?php

namespace App\Exports;

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

class PemeriksaanPerPasienExport implements FromView, WithEvents, ShouldAutoSize, WithProperties
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

                // Terapkan border hitam ke kolom B dan D
                $sheet->getStyle('A20:S24')->applyFromArray($borderStyle);
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

        $page_title = ($this->kategoriperiksa == 'bumil') ? "Pemeriksaan Ibu Hamil" : "Pemeriksaan Nifas";

        return view('exports.pemeriksaan_per_pasien', [
            'page_title' => $page_title,
            'dataRows' => $dataRows,
            'dataPasien' => $dataPasien,
        ]);
    }
}

