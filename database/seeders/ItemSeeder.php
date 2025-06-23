<?php

namespace Database\Seeders;

use App\Models\Inventory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['Plastic Chair', 'pcs', 'Used in lecture halls'],
            ['Fire Extinguisher', 'pcs', 'For lab and building safety'],
            ['Projector Screen', 'pcs', 'Installed in lecture rooms'],
            ['Desktop Computer', 'pcs', 'Used in the computer lab'],
            ['Laptop Charger', 'pcs', 'Compatible with HP and Dell laptops'],
            ['Whiteboard Marker', 'packs', 'For classroom whiteboards'],
            ['Ceiling Fan', 'pcs', 'Installed in all lecture halls'],
            ['Microscope', 'pcs', 'Used in science laboratories'],
            ['Air Conditioner', 'pcs', 'Installed in offices'],
            ['Office Table', 'pcs', 'Used in staff offices'],
            ['Electric Kettle', 'pcs', 'Used in staff lounges'],
            ['Printer Ink', 'boxes', 'Used in department printers'],
            ['Light Bulb', 'pcs', 'For classroom lighting'],
            ['Generator Oil', 'litres', 'For maintaining standby generators'],
            ['Projector', 'pcs', 'Used for presentations'],
            ['Scanner', 'pcs', 'Used in administrative offices'],
            ['CCTV Camera', 'pcs', 'Security installations'],
            ['Router', 'pcs', 'For internet connectivity'],
            ['Fire Blanket', 'pcs', 'Safety equipment'],
            ['Extension Cord', 'pcs', 'Used in various rooms'],
            ['Speaker System', 'pcs', 'Audio output for events'],
            ['HDMI Cable', 'pcs', 'Connecting multimedia devices'],
            ['Wi-Fi Repeater', 'pcs', 'Extends Wi-Fi range'],
            ['Whiteboard', 'pcs', 'Used in lecture rooms'],
            ['Inverter Battery', 'pcs', 'Backup power supply'],
            ['Solar Panel', 'pcs', 'Alternative energy source'],
            ['Water Dispenser', 'pcs', 'Used in halls and offices'],
            ['First Aid Box', 'pcs', 'Emergency medical supply'],
            ['Broom', 'pcs', 'For cleaning classrooms'],
            ['Lab Coat', 'pcs', 'Used by science students'],
        ];

        foreach ($items as [$name, $unit, $description]) {
            Inventory::create([
                'name' => $name,
                'quantity' => rand(5, 100),
                'unit' => $unit,
                'description' => $description,
                'type' => 'item',
            ]);
        }
    }
}
