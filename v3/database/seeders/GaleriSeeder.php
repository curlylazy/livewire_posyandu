<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Lib\Csql;
use App\Models\ActivityModel;
use App\Models\GaleriModel;
use App\Models\PackageModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

class GaleriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=12;$i++)
        {
            GaleriModel::create([
                "namagaleri" => "Galeri ".$i,
                "gambargaleri" => "galeri".$i,
            ]);
        }
    }
}
