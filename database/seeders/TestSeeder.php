<?php

namespace Database\Seeders;

use App\Models\Test;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Test::insert([
[
                'name' => 'Depression Test',
                'type' => 'depression',
                'description' => 'Self-assessment for depression symptoms',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Anxiety Test',
                'type' => 'anxiety',
                'description' => 'Self-assessment for anxiety symptoms',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bipolar Test',
                'type' => 'bipolar',
                'description' => 'Self-assessment for mood patterns',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
