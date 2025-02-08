<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class item_daywork_lcm extends Seeder
{

    public function run(): void
    {
        $items = [
            'Excavator 80 Ton / R850LC-9',
            'Excavator 80 Ton / CLG975E',
            'Excavator 80 Ton / DX800LC-5B',
            'Excavator 30 Ton / XZ350',
            'Excavator 30 Ton / DX300LCA',
            'Excavator 20 Ton / DX200A-7M',
            'Dump Truck OB 55 Ton / 875KR',
            'Dump Truck OB 55 Ton / DW90A',
            'Dump Truck Coal 30 Ton / TRAKER 380',
            'Dump Truck Coal 30 Ton / HINO 500',
            'Dump Truck Coal 20 Ton / FM260',
            'Dump Truck Coal 20 Ton / FUSO',
            'Dozer 20 ton / ZD220-3',
            'Dozer 20 ton / B230',
            'Dozer 30 ton / SD32',
            'Grader 13 Ton / G9220F',
            'Grader 13 Ton / G4260-R',
            'Tower Lamp / LSW6Y',
        ];

        foreach ($items as $index => $name) {
            DB::table('item_daywork_lcm')->insert([
                'id_item_daywork_lcm' => $index + 1,
                'nama_item' => $name,
            ]);
        }
    }
}
