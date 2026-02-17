<?php

namespace App\Lib;

use Illuminate\Support\Arr;

class GetString
{
	public static function getStatusPesanan($val)
	{
		$res = "";

        if($val == 0) {
            $res = "Belum Dikerjakan";
        } else if($val == 1) {
            $res = "Sedang Dikerjakan";
        } else if($val == 2) {
            $res = "Siap Dikirim";
        } else if($val == 3) {
            $res = "Selesai";
        } else if($val == 9) {
            $res = "Batal";
        }

        return $res;
	}

	public static function getStatusBayar($val)
	{
		$res = "";

        if($val == 0) {
            $res = "Belum Lunas";
        } else {
            $res = "Lunas";
        }

        return $res;
	}

	public static function getTipeBahanBaku($val)
	{
		$res = "";

        if($val == 1) {
            $res = "Bahan Baku";
        } else if($val == 2) {
            $res = "Jasa";
        } else {
            $res = "--";
        }

        return $res;
	}

	public static function getKehadiran($val, $styled = false)
	{
		$res = "";

        if($styled)
        {
            if($val == 0) {
                $res = "<span class='fw-bold text-danger'>Tidak Hadir</span>";
            } else if($val == 1) {
                $res = "<span class='fw-bold text-success'>Hadir</span>";
            } else {
                $res = "--";
            }
        }
        else
        {
            if($val == 0) {
                $res = "Tidak Hadir";
            } else if($val == 1) {
                $res = "Hadir";
            } else {
                $res = "--";
            }
        }

        return $res;
	}

    public static function getKategoriUmur($val)
	{
		$res = "";

        if($val >= 0 && $val <= 5) {
            $res = "Balita";
        } else if($val >= 6 && $val <= 12) {
            $res = "Anak-anak";
        } else if($val >= 13 && $val <= 17) {
            $res = "Remaja";
        } else if($val >= 18 && $val <= 59) {
            $res = "Dewasa";
        } else {
            $res = "Lansia";
        }

        return $res;
	}

    public static function getJK($val)
	{
		$res = "";

        if($val == "L") {
            $res = "Laki - laki";
        } else {
            $res = "Perempuan";
        }

        return $res;
	}

    public static function getJudulByKategoriPeriksa($kategori)
	{
		$res = "";

        if($kategori == "bumil") {
            $res = "Ibu Hamil";
        } elseif($kategori == "nifas") {
            $res = "Nifas dan Menyusui";
        } elseif($kategori == "bayi") {
            $res = "Bayi-Apras-Anak";
        }

        return $res;
	}

}
