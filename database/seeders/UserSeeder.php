<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

use App\Lib\Csql;
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

        $user = UserModel::where('username', 'admin')->first();
        $user->assignRole('admin');
    }
}
