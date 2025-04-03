<?php

namespace App\Lib;

use Illuminate\Support\Facades\Storage;

class ImageUtils
{
	public static function getImage($name)
    {
        $res = "";

        if(empty($name)){
            $res = asset("static/noimage.jpg");
            return $res;
        }

        if (Storage::exists("image/$name")) {
            $res = asset("img/$name");
        } else {
            $res = asset("static/noimage.jpg");
        }

        return $res;
    }

	public static function getImageThumb($name)
    {
        $res = "";

        if(empty($name)){
            $res = asset("static/noimage.jpg");
            return $res;
        }

        if (Storage::exists("image/thumb/$name")) {
            $res = asset("img/thumb/$name");
        } else {
            $res = asset("static/noimage.jpg");
        }

        return $res;
    }

	public static function getImagePdf($name)
    {
        $res = "";

        if(empty($name)){
            $res = public_path("noimage.jpg");
            return $res;
        }

        if (Storage::exists("image/$name")) {
            $res = public_path("img/$name");
        } else {
            $res = public_path("noimage.jpg");
        }

        return $res;
    }
}
