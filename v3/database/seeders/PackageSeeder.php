<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Lib\Csql;
use App\Models\ActivityModel;
use App\Models\PackageModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PackageModel::create([
            "namapackage" => "Bali Rural Adventure Package",
            "keterangan" => "Include lunch [3 - 4 Hours] - Minimum 2 pax, Start from 8:00 AM",
            "activityinclude" => json_encode(ActivityModel::pluck('namaactivity')),
            "harga" => 1500000,
            "seopackage" => Str::slug('Bali Rural Adventure Package'),
        ]);

        PackageModel::create([
            "namapackage" => "Family Group For 5 People",
            "keterangan" => "Include lunch [4 - 5 Hours] - Start from 8:00 AM",
            "activityinclude" => json_encode(ActivityModel::pluck('namaactivity')),
            "harga" => 3500000,
            "seopackage" => Str::slug('Family Group For 5 People'),
        ]);

    }
}
