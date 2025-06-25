<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TranscriptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 40; $i <= 54; $i++) {
            DB::table('transcripts')->insert([
                'user_id' => $i,
                'status' => 'completed',
                'transaction_id' => 'FED/TRS/' . date('Y') . '/' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
