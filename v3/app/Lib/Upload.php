<?php

namespace App\Lib;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class Upload
{
	public static function image($file, $oldFile = "", $withThumb = false)
    {
        // *** jika oldfile ada, maka hapus file yang lama
        // cek terlebih dahulu, apakah ada
        if(!empty($oldFile))
        {
            self::deleteImage($oldFile);
        }

        // *** upload file
        $name = $file->hashName();
        $extension = $file->extension();
        $file->storeAs(path: 'image', name: $name);

        // *** upload thumbnail
        if($withThumb)
        {
            // $manager = new ImageManager(new Driver());
            // $image = $manager->read("logo.jpg");
            // $image->resize(width: 300);
            // $image->save("$name");
            // Storage::put("image/thumb/$name", (string) $image->encode());

            // *** read from file
            // $image = ImageManager::gd()->read($file)->scale(width: 500)->toJpeg();
            // Storage::put("image/thumb/$name", (string) $image);

            // if($extension == 'jpeg' || $extension == 'jpg')
            //     $image = ImageManager::gd()->read($file)->scale(width: 500)->toJpeg();
            // elseif($extension == 'png')
            //     $image = ImageManager::gd()->read($file)->scale(width: 500)->toPng();

            $image = ImageManager::gd()->read($file)->scale(width: 500)->toJpeg();
            Storage::put("image/thumb/$name", (string) $image);
        }

        return $name;
    }

    public static function deleteImage($file)
    {
        if(!empty($file))
        {
            // *** gambar utama
            if (Storage::exists("image/$file")) {
                Storage::delete("image/$file");
            }

            // *** gambar thumb
            if (Storage::exists("image/thumb/$file")) {
                Storage::delete("image/thumb/$file");
            }
        }
    }
}
