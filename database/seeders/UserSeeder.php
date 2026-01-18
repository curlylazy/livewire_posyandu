<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

use App\Lib\Csql;
use App\Models\PosyanduModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserModel::create([
            "username" => "admin",
            "namauser" => "Admin ".config('app.webname'),
            "akses" => "admin",
            "password" => Hash::make("@12345"),
        ]);

        $kodeposyandu = PosyanduModel::where('namaposyandu', 'Kebonkuri Lukluk')->first()->kodeposyandu;
        UserModel::create([
            "username" => "staff",
            "kodeposyandu" => $kodeposyandu,
            "namauser" => "Staff ".config('app.webname'),
            "akses" => "staff",
            "password" => Hash::make("@12345"),
        ]);

        $user = UserModel::where('username', 'admin')->first();
        $user->assignRole('admin');

        $user = UserModel::where('username', 'staff')->first();
        $user->assignRole('staff');
    }
}
