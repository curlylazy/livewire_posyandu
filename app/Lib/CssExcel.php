<?php

namespace App\Lib;

use App\Models\PesanDTModel;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CssExcel
{
    public static $pageTitle = "font-weight: bold; font-size: 15pt; width: 100px";
    public static $pageSubTitle = "font-weight: bold; font-size: 12pt; width: 100px";
    public static $heading = "font-weight: bold; font-size: 15pt; text-align: center; background-color: #FFB6C1; height: 50px;";
    public static $rowSize200 = "font-weight: bold; width: 200px;";
    public static $rowSize250 = "font-weight: bold; width: 250px;";
    public static $rowSize300 = "font-weight: bold; width: 300px;";
    public static $rowSize350 = "font-weight: bold; width: 350px;";
    public static $rowSize400 = "font-weight: bold; width: 400px;";

    public static $textCenter = "text-align: center;";

    public static $bgPink = "background-color: #DDC0B4;";
    public static $bgGray = "background-color: #D9D9D9;";
    public static $bgLightYellow = "background-color: #FDFD96;";
    public static $bgYellow = "background-color: #FFFFCC;";
    public static $bgLightBlue = "background-color: #D0D8E8;";
    public static $bgPurple = "background-color: #CCBBEB;";

    public static $rowSize100Light = "width: 100px;";
    public static $rowSize150Light = "width: 100px;";
    public static $rowSize200Light = "width: 200px;";
    public static $rowSize250Light = "width: 250px;";
    public static $rowSize300Light = "width: 300px;";
    public static $rowSize350Light = "width: 350px;";
    public static $rowSize400Light = "width: 400px;";

    public static $rowHeight25px = "height: 25px;";
    public static $rowHeight50px = "height: 50px;";
    public static $rowHeight100px = "height: 100px;";
    public static $rowHeight150px = "height: 150px;";
    public static $rowHeight200px = "height: 200px;";

    public static $pageResult = "font-weight: bold; font-size: 14pt;";

    public static function setBackground($value)
    {
        $res = "";
        if($value) {
            $res = "color: white; background-color: #015917;";
        } else {
            $res = "color: white; background-color: #910101;";
        }

        return $res;
    }

    public static function columnBreak($count)
    {
        $res = collect();
        for($i=1;$i<=$count;$i++)
        {
            $res->push('<th></th>');
        }

        return $res->join('');
    }

    public static function rowBreak($count)
    {
        $res = collect();
        for($i=1;$i<=$count;$i++)
        {
            $res->push('<tr></tr>');
        }

        return $res->join('');
    }
}
