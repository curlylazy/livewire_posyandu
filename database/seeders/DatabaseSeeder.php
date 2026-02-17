<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PosyanduSeeder::class,
            UserSeeder::class,
            PasienSeeder::class,
            // BayiSeeder::class,
            // PackageSeeder::class,
            // GaleriSeeder::class,
        ]);
    }
}
