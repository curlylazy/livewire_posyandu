<?php

namespace Database\Seeders;

use App\Models\BayiModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\PasienModel;
use App\Models\UserModel;

class BayiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for($i=1;$i<=20;$i++)
        {

            $dataPasien = PasienModel::inRandomOrder()->first();
            $kodepasien = $dataPasien->kodepasien;
            $hamil_ke = $dataPasien->hamil_ke;
            $gender = $faker->randomElements(['male', 'female']);
            $tempatbersalin = $faker->randomElements(['RS Wangaya', 'RS Badung', 'RS Kasih Ibu', 'RS Tuban']);
            $jk = ($gender == 'male') ? 'L' : 'P';

            BayiModel::create([
                'kodepasien' => $kodepasien,
                'namabayi' => $faker->name(gender: $gender[0]),
                'anakke' => $faker->numberBetween(1, $hamil_ke),
                'tinggibadan' => $faker->numberBetween(49, 80),
                'beratbadan' => $faker->randomFloat(3, 4, 5, 6),
                'carabersalin' => $faker->numberBetween(1, 5),
                'tgl_lahir' => $faker->dateTimeBetween('-5 months', '-1 months'),
                'tgl_bersalin' => date('Y-m-d'),
                'jk' => $jk,
                'tempatbersalin' => $tempatbersalin[0],
            ]);
        }

    }
}
