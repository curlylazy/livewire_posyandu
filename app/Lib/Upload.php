<?php

namespace App\Lib;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;

class Upload
{
    public static function image($file, $oldFile = '', $withThumb = false)
    {
        // *** jika oldfile ada, maka hapus file yang lama
        // cek terlebih dahulu, apakah ada
        if (! empty($oldFile)) {
            self::deleteImage($oldFile);
        }

        // *** upload file
        $date = now()->format('Y_m_d_his'); // 20260221
        $random = Str::random(8);
        $extension = $file->getClientOriginalExtension();
        $name = "{$date}_{$random}.{$extension}";

        // *** upload thumbnail
        if ($withThumb) {
            $image = ImageManager::gd()->read($file->getPathname())->scale(width: 500)->toJpeg();
            Storage::put("image/thumb/$name", (string) $image);
        }

        $file->storeAs(path: 'image', name: $name);

        return $name;
    }

    public static function deleteImage($file)
    {
        if (! empty($file)) {
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
