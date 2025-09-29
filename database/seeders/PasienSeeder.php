<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\PasienModel;
use App\Models\PosyanduModel;
use App\Models\UserModel;
use Carbon\Carbon;

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
        $kodeuser = UserModel::where('username', 'admin')->first()->kodeuser;
        $kodeposyandu = PosyanduModel::searchBySeo('kebonkuri-lukluk')->first()->kodeposyandu;

        // *** pria dewasa
        for($i=1;$i<=15;$i++)
        {
            PasienModel::create([
                'kodeposyandu' => $kodeposyandu,
                'kodeuser' => $kodeuser,
                'nik' => $faker->nik(),
                'namapasien' => $faker->name(gender: 'male'),
                'tgl_lahir' => $faker->dateTimeBetween('-40 years', '-30 years'),
                'alamat' => $faker->address(),
                'nohp' => $faker->phoneNumber(),
                'beratbadan' => $faker->numberBetween(55, 120),
                'status' => 1,
            ]);
        }

        // *** bumil
        for($i=1;$i<=10;$i++)
        {
            PasienModel::create([
                'kodeposyandu' => $kodeposyandu,
                'kodeuser' => $kodeuser,
                'kategoripasien' => 'bumil',
                'nik' => $faker->nik(),
                'namapasien' => $faker->name(gender: 'female'),
                'jk' => "P",
                'tgl_lahir' => $faker->dateTimeBetween('-40 years', '-30 years'),
                'alamat' => $faker->address(),
                'nohp' => $faker->phoneNumber(),
                'hamil_ke' => $faker->numberBetween(1, 6),
                'minggu_ke' => $faker->numberBetween(10, 50),
                'beratbadan' => $faker->numberBetween(85, 120),
                'lila' => $faker->randomFloat(20, 30, 35),
                'tekanan_darah' => '',
                'status' => 1,
            ]);
        }

        // *** nifas
        for($i=1;$i<=10;$i++)
        {
            PasienModel::create([
                'kodeposyandu' => $kodeposyandu,
                'kodeuser' => $kodeuser,
                'kategoripasien' => 'nifas',
                'nik' => $faker->nik(),
                'namapasien' => $faker->name(gender: 'female'),
                'jk' => "P",
                'tgl_lahir' => $faker->dateTimeBetween('-40 years', '-30 years'),
                'alamat' => $faker->address(),
                'nohp' => $faker->phoneNumber(),
                'hamil_ke' => $faker->numberBetween(1, 6),
                'minggu_ke' => $faker->numberBetween(10, 50),
                'beratbadan' => $faker->numberBetween(85, 120),
                'lila' => $faker->randomFloat(20, 30, 35),
                'tekanan_darah' => '',
                'status' => 1,
            ]);
        }

        // *** balita
        // untuk balita 0 - 5 tahun
        for($i=1;$i<=10;$i++)
        {
            // $dataIbu =  PasienModel::selectCustom()->searchByPerempuanDewasa()->inRandomOrder()->first();
            // $dataAyah =  PasienModel::selectCustom()->searchByLakiDewasa()->inRandomOrder()->first();
            $dataIbu =  PasienModel::selectCustom()->searchByPerempuanDewasa()->inRandomOrder()->first();
            $dataAyah =  PasienModel::selectCustom()->searchByLakiDewasa()->inRandomOrder()->first();
            $tgl_lahir = $faker->dateTimeBetween('-4 years', '-1 years');

            PasienModel::create([
                'kodeposyandu' => $kodeposyandu,
                'kodeuser' => $kodeuser,
                'kodeibu' => $dataIbu->kodepasien,
                'kodeayah' => $dataAyah->kodepasien,
                'namapasien' => $faker->name(),
                'tgl_lahir' => $tgl_lahir,
                'alamat' => $faker->address(),
                'beratbadan' => $faker->numberBetween(85, 120),
                'tinggibadan_lahir' => $faker->numberBetween(55, 120),
                'beratbadan_lahir' => $faker->numberBetween(1, 10),
                'tinggibadan' => $faker->numberBetween(55, 120),
                'carabersalin' => $faker->numberBetween(1, 10),
                'tgl_bersalin' => Carbon::parse($tgl_lahir)->addDays(-2),
                'status' => 1,
            ]);
        }
    }
}
