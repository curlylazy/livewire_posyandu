<?php

namespace App\Lib;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class GenerateKode
{
	public static function generateKode($kode, $prefix, $table)
    {
        $nomer = "00001";
		$autonum = "";
        $autonum = DB::table($table)->max($kode);

        $nomer_len = strlen($nomer);

		# Cek Parameter
		if($autonum == "")
		{
			$autonum = $prefix.$nomer;
		}
		else
		{
			$autonum = (int) substr($autonum, strlen($prefix), $nomer_len + 1);
			$autonum++;
			$autonum =  $prefix.sprintf('%0'.($nomer_len).'s', $autonum);
		}

		return $autonum;
    }

}
