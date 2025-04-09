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

    public static function dateDiffInYear($date)
    {
        $dbDate = \Carbon\Carbon::parse($date);
        $diffYears = \Carbon\Carbon::now()->diffInYears($dbDate);
        return $diffYears;
    }

    public static function dateDiff($date)
    {
        $dbDate = \Carbon\Carbon::parse($date);
        $diffYears = \Carbon\Carbon::now()->diff($dbDate);
        return $diffYears->format('%y Tahun, %m Bulan');
    }

}
