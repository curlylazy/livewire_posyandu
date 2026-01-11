<?php

namespace App\Http\Controllers;

use App\Models\PemeriksaanModel;
use App\Models\PesanDTModel;
use App\Models\PesanHDModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Spatie\LaravelPdf\Enums\Format;
use Spatie\LaravelPdf\Facades\Pdf;
use Barryvdh\DomPDF\Facade\Pdf as DomPdf;

class PdfController extends Controller
{
    // *** dompdf
    public function cetak_pemeriksaan(Request $request)
    {
        $katakunci = $request->query('katakunci');
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');
        $kategori_periksa = $request->query('kategori_periksa');

        if($kategori_periksa == "bumil"){
            $pageTitle = "Laporan Pemeriksaan Ibu Hamil";
        }

        if($kategori_periksa == "nifas"){
            $pageTitle = "Laporan Pemeriksaan Nifas";
        }

        $pagename = "pemeriksaan";
        $dataRows = PemeriksaanModel::joinTable()
                ->search($katakunci)
                ->searchByMonthYear($bulan, $tahun)
                ->searchByKategoriPeriksa($kategori_periksa)
                ->get();


        return DomPdf::loadView("pdf.$pagename", [
            'pageTitle' => $pageTitle,
            'dataRows' => $dataRows,
            'kategori_periksa' => $kategori_periksa,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ])->setPaper('a4', 'landscape')->stream();
    }

    public function cetak_pemeriksaan_bayi(Request $request)
    {
        $katakunci = $request->query('katakunci');
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');
        $pageTitle = "Laporan Pemeriksaan Bayi";

        $dataRows = PemeriksaanModel::joinTable()
                ->search($katakunci)
                ->searchByMonthYear($bulan, $tahun)
                ->searchByKategoriPeriksa("bayi")
                ->get();

        return DomPdf::loadView("pdf.pemeriksaan_bayi", [
            'pageTitle' => $pageTitle,
            'dataRows' => $dataRows,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ])->setPaper('a4', 'landscape')->stream();
    }

}
