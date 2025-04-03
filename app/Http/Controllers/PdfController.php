<?php

namespace App\Http\Controllers;

use App\Models\PesanDTModel;
use App\Models\PesanHDModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Spatie\LaravelPdf\Enums\Format;
use Spatie\LaravelPdf\Facades\Pdf;
use Barryvdh\DomPDF\Facade\Pdf as DomPdf;

class PdfController extends Controller
{
    // *** Spatie
    public function cetak($id)
    {
        $kode = Crypt::decrypt($id);
        $dataPesanHd = PesanHDModel::joinTable()->searchByNoInvoice($kode)->first();
        $dataPesanDt = PesanDTModel::joinTable()->searchKodePesan($dataPesanHd->kodepesanhd)->get();

        return Pdf::view('pdf.po', [
                'dataPesanHd' => $dataPesanHd,
                'dataPesanDt' => $dataPesanDt,
            ])
            // ->landscape()
            ->format(Format::A4)
            ->name('invoice-2023-04-10.pdf');
    }

    // *** dompdf
    public function cetak_po($id)
    {
        $kode = Crypt::decrypt($id);
        $dataPesanHd = PesanHDModel::joinTable()->searchByNoInvoice($kode)->first();
        $dataPesanDt = PesanDTModel::joinTable()->searchKodePesan($dataPesanHd->kodepesanhd)->get();

        return DomPdf::loadView('pdf.purchase_order', [
                'dataPesanHd' => $dataPesanHd,
                'dataPesanDt' => $dataPesanDt,
            ])->stream();
    }

}
