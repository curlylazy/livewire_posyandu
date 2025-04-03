<?php

namespace App\Lib;

use App\Models\BahanBakuModel;
use App\Models\PesanDTBahanBakuModel;
use Illuminate\Support\Facades\Storage;

class Stok
{
	public static function cekStok($kodebahanbaku)
    {
        $res = 0;
        $res = BahanBakuModel::find($kodebahanbaku)->stok;
        return $res;
    }

    public static function updateStok($kodebahanbaku, $jml)
    {
        $dataBahanBaku = BahanBakuModel::find($kodebahanbaku);
        $stokbahanbaku = $dataBahanBaku->stokbahanbaku;
        $stokSekarang = $stokbahanbaku + $jml;

        $dataBahanBaku->stokbahanbaku = $stokSekarang;
        $dataBahanBaku->save();
    }

    public static function updateStokAll($kodepesandt)
    {
        $dataPesanBahanBaku = PesanDTBahanBakuModel::joinTable()->searchByTipeBahanBaku(1)->searchKodePesanDt($kodepesandt)->get();
        foreach($dataPesanBahanBaku as $data)
        {
            $qty = $data->qty;
            $qtyhabis = $data->qtyhabis;
            self::updateStok($data->kodebahanbaku, (-1 * $qty) * $qtyhabis);
        }
    }

    public static function restoreStok($kodepesandt)
    {
        $dataPesanBahanBaku = PesanDTBahanBakuModel::joinTable()->searchByTipeBahanBaku(1)->searchKodePesanDt($kodepesandt)->get();
        foreach($dataPesanBahanBaku as $data)
        {
            $qty = $data->qty;
            $qtyhabis = $data->qtyhabis;
            self::updateStok($data->kodebahanbaku, $qty * $qtyhabis);
        }
    }
}
