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
                'status' => 1,
            ]);
        }

        // *** pria dewasa
        for($i=1;$i<=15;$i++)
        {
            PasienModel::create([
                'kategoripasien' => 'nifas',
                'nik' => $faker->nik(),
                'namapasien' => $faker->name(gender: 'male'),
                'tgl_lahir' => $faker->dateTimeBetween('-40 years', '-30 years'),
                'alamat' => $faker->address(),
                'nohp' => $faker->phoneNumber(),
                'bb' => $faker->numberBetween(55, 120),
                'status' => 1,
            ]);
        }

        // *** balita
        // untuk balita 0 - 5 tahun
        for($i=1;$i<=10;$i++)
        {
            $dataIbu =  PasienModel::selectCustom()->searchByPerempuanDewasa()->inRandomOrder()->first();
            $dataAyah =  PasienModel::selectCustom()->searchByLakiDewasa()->inRandomOrder()->first();
            $tgl_lahir = $faker->dateTimeBetween('-1 years', '-4 years');

            PasienModel::create([
                'kodeibu' => $dataIbu->kodepasien,
                'kodeayah' => $dataAyah->kodepasien,
                'namapasien' => $faker->name(),
                'tgl_lahir' => $tgl_lahir,
                'alamat' => $faker->address(),
                'bb' => $faker->numberBetween(85, 120),
                'tinggibadan_lahir' => $faker->numberBetween(55, 120),
                'beratbadan_lahir' => $faker->numberBetween(1, 10),
                'tinggibadan' => $faker->numberBetween(55, 120),
                'carabersalin' => $faker->numberBetween(1, 10),
                'tgl_bersalin' => $tgl_lahir,
                'status' => 1,
            ]);
        }
    }
}
