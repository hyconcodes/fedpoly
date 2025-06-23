<?php

namespace Database\Seeders;

use App\Models\Inventory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Inventory::truncate();
        $structures = [
            'Science Block',
            'Library',
            'Admin Building',
            'Engineering Workshop',
            'Lecture Hall A',
            'Lecture Hall B',
            'ICT Center',
            'Medical Center',
            'Auditorium',
            'Cafeteria',
            'Staff Quarters',
            'Sports Complex',
            'Security Gate',
            'Parking Lot',
            'Maintenance Shed',
        ];

        foreach ($structures as $name) {
            Inventory::create([
                'name' => $name,
                'type' => 'structure',
                'location' => fake()->city(),
                'description' => fake()->sentence(),
            ]);
        }

    }
}
