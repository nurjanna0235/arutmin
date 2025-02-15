<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class kontraktor extends Seeder
{
       public function run(): void
    {
        DB::table('kontraktor')->insert([
            [
                'id_kontraktor' => '1',
                'nama_kontraktor' => 'Darma Henwa (Asteng)',
            ],
            [
                'id_kontraktor' => '2',
                'nama_kontraktor' => 'Darma Henwa (Asbar)',
            ],
            [
                'id_kontraktor' => '3',
                'nama_kontraktor' => 'Laz Coal Mandiri (Astim)',
            ],

        ]);
    }
}
