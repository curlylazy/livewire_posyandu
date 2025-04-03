<?php

namespace App\Lib;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class FilterString
{
	public static function cekLogin()
    {
        $data['pagename'] = "asdasdas";
        redirect()->route('login');
    }

	public static function filterInt($value)
	{
		$res = "";
		$res = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
		return $res;
	}

	public static function filterString($value)
	{
		$res = "";
		$res = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH);
		// $res = htmlspecialchars($value);
		return $res;
	}

	public static function filterDate($date)
	{
		$res = empty($date) ? null : Carbon::parse($date);
		return $res;
	}

    public static function isDigits(string $s, int $minDigits = 9, int $maxDigits = 14): bool {
        return preg_match('/^[0-9]{'.$minDigits.','.$maxDigits.'}\z/', $s);
    }

    public static function isValidPhoneNumber(string $telephone, int $minDigits = 9, int $maxDigits = 14): bool {
        if (preg_match('/^[+][0-9]/', $telephone)) { //is the first character + followed by a digit
            $count = 1;
            $telephone = str_replace(['+'], '', $telephone, $count); //remove +
        }

        //remove white space, dots, hyphens and brackets
        $telephone = str_replace([' ', '.', '-', '(', ')'], '', $telephone);

        //are we left with digits only?
        return self::isDigits($telephone, $minDigits, $maxDigits);
    }

	public static function filterSEO($judul, $kode)
    {
        // megubah karakter non huruf dengan strip
        $judul = preg_replace('~[^\\pL\d]+~u', '-', $judul);
        $judul = trim($judul, '-');
        $judul = iconv('utf-8', 'us-ascii//TRANSLIT', $judul);
        $judul = strtolower($judul);
        $judul = preg_replace('~[^-\w]+~', '', $judul);
        if (empty($judul))
        {
            return 'n-a';
        }

        return strtolower($judul."-".$kode);
    }

}
