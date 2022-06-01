<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin = new User;
        $admin->username = 'administrator';
        $admin->name = 'Site Administrator';
        $admin->email = 'admin@gmail.com';
        $admin->roles = json_encode('ADMIN');
        $admin->password = Hash::make('larashop');
        $admin->avatar = "saat-ini-tidak-ada-avatar.png";
        $admin->address = "Kota virtual";
        $admin->save();
        $this->command->info("User admin berhasil di insert");
    }
}
