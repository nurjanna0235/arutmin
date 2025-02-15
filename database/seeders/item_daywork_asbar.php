<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class item_daywork_asbar extends Seeder
{

    public function run()
    {
        $items = [
            'Excavator 20 Ton / PC200 / ZX200',
            'Excavator 30 Ton / PC300 / Cat 325D / ZX330',
            'Excavator 40 Ton / PC400 / ZX450',
            'Excavator 50 Ton / DX500',
            'Excavator 50 Ton / DX800',
            'Excavator 120 Ton / EX1200',
            'Excavator 120 Ton / PC1250',
            'Excavator 200 Ton / PC2000',
            'Excavator 250 Ton / EX2500',
            'Excavator 260 Ton / EX2600',
            'Front-End Loader (FEL) Cat 992G (min. 250 hrs)',
            'Front-End Loader (FEL) Cat 992G (min. 300 hrs)',
            'Front-End Loader (FEL) Cat 992G (min. 350 hrs)',
            'Loader WA500',
            'HD785 / 777D',
            'Cat 777A',
            'HD465 / 773E',
            'Iveco / Hino',
            'Volvo FM440',
            'CWB45',
            'DT Hino',
            'Dozer D85ESS / D7G',
            'Dozer D8 / D155',
            'Dozer D375A / D10T (min. 250 hrs)',
            'Dozer D375A / D10T (min. 300 hrs)',
            'Dozer D375A / D10T (min. 350 hrs)',
            'Grader 16H / GD825',
            'Grader 14H / GD705',
            'Grader 12 H',
            'Compactor',
            'Water Pump LC100',
            'Water Pump LC200',
            'Water Pump MF420E',
            'Lightning Plant',
            'Water Truck 20KL',
            'Fuel Truck',
            'Crane Truck',
            'Hydraulik Excavator (HL) 200',
            'Crane 55 Ton',
            'National Suptent',
            'National Spv',
            'Operator',
            'Labour',
            'Mechanic',
        ];

        foreach ($items as $index => $name) {
            DB::table('item_daywork_asbar')->insert([
                'id_item_daywork_asbar' => $index + 1,
                'nama_item' => $name,
            ]);
        }
    }
}
