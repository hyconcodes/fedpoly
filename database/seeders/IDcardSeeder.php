<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IDcardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 23; $i <= 50; $i++) {
            DB::table('idcards')->insert([
                'user_id' => $i,
                'status' => 'completed',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
