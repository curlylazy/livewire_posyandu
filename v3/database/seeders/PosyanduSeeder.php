<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use App\Models\PasienModel;
use App\Models\PosyanduModel;
use App\Models\UserModel;
use Carbon\Carbon;

class PosyanduSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $arrData = array("Ujung", "Ceramcam", "Dauh Tangkluk", "Pebean", "Dangin Tangkluk", "Kesumajati", "Dajan Tangkluk", "Abian Tubuh",
            "Kebonkuri Lukluk", "Kebonkori Tengah", "Kebonkori Kelod", "Bhuana Anyar", "Kebonkuri Mangku", "Buaji Anyar");

        foreach($arrData as $namaposyandu)
        {
            PosyanduModel::create([
                'namaposyandu' => $namaposyandu,
                'seoposyandu' => Str::slug($namaposyandu),
            ]);
        }

    }
}
