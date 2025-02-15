<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class pengguna extends Seeder
{

    public function run(): void
    {
        DB::table('pengguna')->insert([
            [
                'username' => 'janna',
                'password' => Hash::make('123'),
                'email' => 'janna@gmail.com',
                'level' => 'admin',
                'nik' => '1234',
                'created_at' => now(),
                'updated_at' => now(),
                'foto_profil' => 'default.jpg'
            ],
        ]);
    }
}
