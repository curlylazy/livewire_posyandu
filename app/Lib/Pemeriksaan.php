<?php

namespace App\Lib;

use App\Models\PesanDTModel;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class Pemeriksaan
{
	public static function isBeratBadanNaik($bbSaatIni, $bbSebelumnya)
	{
        $res = ($bbSaatIni > $bbSebelumnya) ? true : false;
        return $res;
	}

    public static function kesimpulanBeratBadan($umur, $bb)
	{
        $res = "";
        $bbIdeal = ($umur * 2) + 8;
        $persentase = ($bb / $bbIdeal) * 100;

        if($persentase < 70) {
            $res = "Sangat Kurang";
        } elseif($persentase >= 70 && $persentase <= 90) {
            $res = "Kurang";
        } elseif($persentase >= 90 && $persentase <= 110) {
            $res = "Normal";
        } else {
            $res = "Berlebih";
        }

        return $res;
	}

    public static function kesimpulanTinggiBadan($umur, $tinggi)
	{
        $res = "";
        $tinggiIdeal = ($umur * 6) + 77;
        $persentase = ($tinggi / $tinggiIdeal) * 100;

        if($persentase < 85) {
            $res = "Sangat Pendek";
        } elseif($persentase >= 85 && $persentase <= 95) {
            $res = "Pendek";
        } elseif($persentase > 95 && $persentase <= 110) {
            $res = "Normal";
        } else {
            $res = "Tinggi";
        }

        return $res;
	}

    public static function kesimpulanGizi($umur, $bb)
	{
        $res = "";
        $bbIdeal = ($umur * 2) + 8;
        $persentase = ($bb / $bbIdeal) * 100;

        if($persentase < 70) {
            $res = "Gizi Buruk";
        } elseif($persentase >= 70 && $persentase <= 80) {
            $res = "Gizi Kurang";
        } elseif($persentase > 80 && $persentase <= 120) {
            $res = "Normal";
        } else {
            $res = "Gizi Lebih";
        }

        return $res;
	}

    public static function kesimpulanLingkarKepala($umur, $lk, $jenis_kelamin)
	{
        $res = "";

        // *** Tabel WHO sederhana (0-24 bulan)
        $tabel = [
            'L' => [ // Laki-laki
                0 => [31.9, 37.0],
                1 => [34.9, 39.6],
                3 => [38.3, 42.9],
                6 => [41.0, 45.6],
                9 => [42.8, 47.5],
                12 => [44.1, 48.9],
                18 => [45.8, 50.5],
                24 => [47.2, 51.7],
            ],
            'P' => [ // Perempuan
                0 => [31.5, 36.2],
                1 => [34.2, 39.1],
                3 => [37.3, 42.1],
                6 => [39.5, 44.3],
                9 => [41.0, 46.0],
                12 => [42.1, 47.2],
                18 => [43.7, 48.7],
                24 => [45.0, 50.0],
            ]
        ];

        // Tentukan kelompok usia terdekat di tabel
        $usia_terdekat = 0;
        foreach (array_keys($tabel[$jenis_kelamin]) as $usia) {
            if ($usia <= $umur) {
                $usia_terdekat = $usia;
            }
        }

        $rentang = $tabel[$jenis_kelamin][$usia_terdekat];

        if ($lk < $rentang[0]) {
            $res = "Mikrosefali (Kepala Kecil)";
        } elseif ($lk > $rentang[1]) {
            $res = "Makrosefali (Kepala Besar)";
        } else {
            $res = "Normal";
        }

        return $res;
	}

    public static function kesimpulanLila($lila)
	{
        if($lila < 11.5) {
            $res = "Gizi Buruk";
        } elseif($lila >= 11.5 && $lila <= 12.4) {
            $res = "Gizi Kurang";
        } else {
            $res = "Normal";
        }

        return $res;
	}

}
