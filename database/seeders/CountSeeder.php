<?php

namespace Database\Seeders;

use App\Models\Count;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $range = rand(1680350400, 1682856000);

            Count::create([
                'user_id' => 1,
                'ip_address' => '127.0.0.1',
                'foreign_key_id' => rand(1, 4),
                'type' => 'Link',
                'date' => date("Y-m-d", $range)
            ]);
        }

        for ($i = 0; $i < 100; $i++) {
            $range = rand(1680350400, 1682856000);

            Count::create([
                'user_id' => 1,
                'ip_address' => '127.0.0.1',
                'foreign_key_id' => 1,
                'type' => 'User',
                'date' => date("Y-m-d", $range)
            ]);
        }
    }
}
