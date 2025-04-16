<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\PasienModel;
use App\Models\UserModel;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        // *** bumil
        for($i=1;$i<=10;$i++)
        {
            PasienModel::create([
                'kategoripasien' => 'bumil',
                'nik' => $faker->nik(),
                'namapasien' => $faker->name(gender: 'female'),
                'tgl_lahir' => $faker->dateTimeBetween('-40 years', '-30 years'),
                'alamat' => $faker->address(),
                'nohp' => $faker->phoneNumber(),
                'hamil_ke' => $faker->numberBetween(1, 6),
                'minggu_ke' => $faker->numberBetween(10, 50),
                'bb' => $faker->numberBetween(85, 120),
                'lila' => $faker->randomFloat(20, 30, 35),
                'tekanan_darah' => '',
                'nama_suami' => $faker->name(gender: 'male'),
                'status' => 1,
            ]);
        }

        // *** nifas
        for($i=1;$i<=10;$i++)
        {
            PasienModel::create([
                'kategoripasien' => 'nifas',
                'nik' => $faker->nik(),
                'namapasien' => $faker->name(gender: 'female'),
                'tgl_lahir' => $faker->dateTimeBetween('-40 years', '-30 years'),
                'alamat' => $faker->address(),
                'nohp' => $faker->phoneNumber(),
                'hamil_ke' => $faker->numberBetween(1, 6),
                'minggu_ke' => $faker->numberBetween(10, 50),
                'bb' => $faker->numberBetween(85, 120),
                'lila' => $faker->randomFloat(20, 30, 35),
                'tekanan_darah' => '',
                'nama_suami' => $faker->name(gender: 'male'),
                'status' => 1,
            ]);
        }
    }
}
