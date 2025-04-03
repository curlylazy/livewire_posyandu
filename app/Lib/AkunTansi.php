<?php

namespace App\Lib;

use App\Models\PesanDTModel;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class AkunTansi
{
	public static function getTotalHargaPokok($kodepesanhd)
	{
        $res = 0;
        $res = PesanDTModel::select(DB::raw("SUM(qty * hargapokok) as total"))->where('kodepesanhd', $kodepesanhd)->first();
        return $res->total;
	}

}
