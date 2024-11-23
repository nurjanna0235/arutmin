<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class item_daywork extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $items = [
            'Excavator 20 Ton',
            'Excavator 30 Ton',
            'Excavator 40 Ton',
            'Excavator 50 Ton',
            'Excavator 120 Ton',
            'Excavator 250 Ton',
            'Dump Truck 100 Ton',
            'Dump Truck 60 Ton',
            'Dump Truck 30 Ton',
            'Dump Truck 20 Ton',
            'Dozer D85ESS / D7G',
            'Dozer D8 / 155',
            'Dozer D10 / 375',
            'Grader 16H / GD825',
            'Grader 14H / GD705',
            'Compactor',
            'Water Pump LCC100',
            'Water Pump MF420B',
            'Lightning Plant',
            'Water Truck 20KL',
            'National Suptent',
            'National Spv',
            'Operator',
            'Labour',
            'Mechanic',
        ];

        foreach ($items as $index => $name) {
            DB::table('item')->insert([
                'id_item' => $index + 1,
                'nama_item' => $name,
            ]);
        }
    }
}
