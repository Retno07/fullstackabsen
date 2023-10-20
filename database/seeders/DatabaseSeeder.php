<?php

namespace Database\Seeders;

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
    User::create([
        'name'=>'Admin',
        'username'=>'admin',
        'email'=>'admin@gmail.com',
        'password'=>Hash::make('adminadmin'),
        'profesi'=>'Staff',
        'roles'=>1,
    ]);
    // jalankan perintah dibawah ini untuk generate user admin
    // php artisan db:seed --class=UserSeeder 
}
}
