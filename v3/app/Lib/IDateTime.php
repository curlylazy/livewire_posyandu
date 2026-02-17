<?php
namespace App\Lib;

class IDateTime
{

    public static function dateDiffToNowTxt($date)
    {

        $datetime1 = new \DateTime('now');
        $datetime2 = new \DateTime($date);
        $interval = $datetime1->diff($datetime2);

        $text = "";
        if ($interval->y > 0)
            $text .= $interval->y . " tahun ";
        if ($interval->m > 0)
            $text .= $interval->m . " bulan ";
        if ($interval->d > 0)
            $text .= $interval->d . " hari ";

        return $text;
    }

    public static function formatDate($date, $isoFormat = "DD MMMM Y")
    {
        $res = \Carbon\Carbon::parse($date)->isoFormat($isoFormat);
        return $res;
    }

    public static function dateDiff($date, $date2 = "", $in = "year")
    {
        // $dbDate = \Carbon\Carbon::parse($date);
        // $diffYears = \Carbon\Carbon::now()->diffInYears($dbDate);
        // return $diffYears;

        $date1 = \Carbon\Carbon::parse($date);
        $date2 = ($date2 == "") ? \Carbon\Carbon::now() : $date2;
        $diff = $date1->diff($date2);

        if($in == "year"){
            return $diff->y;
        }

        if($in == "month"){
            return $diff->m;
        }

        if($in == "days"){
            return $diff->d;
        }

        else
        {
            return $diff;
        }

    }

    public static function dateDiffFormat($date)
    {
        $dbDate = \Carbon\Carbon::parse($date);
        $diffYears = \Carbon\Carbon::now()->diff($dbDate);
        return $diffYears->format('%y Tahun, %m Bulan');
    }

    public static function getMonth($date)
    {
        $res = date('m', strtotime($date));
        return $res;
    }

    public static function getYear($date)
    {
        $res = date('Y', strtotime($date));
        return $res;
    }

}
