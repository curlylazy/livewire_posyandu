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

}
