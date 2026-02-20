<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MedicalSchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $schools = [
            [
                'name' => 'University of Medicine 1',
                'country' => 'Myanmar',
                'is_active' => true,
            ],
            [
                'name' => 'University of Medicine 2',
                'country' => 'Myanmar',
                'is_active' => true,
            ],
            [
                'name' => 'University of Medicine, Mandalay',
                'country' => 'Myanmar',
                'is_active' => true,
            ],
            [
                'name' => 'University of Medicine, Magway',
                'country' => 'Myanmar',
                'is_active' => true,
            ],
            [
                'name' => 'University of Medicine, Taunggyi',
                'country' => 'Myanmar',
                'is_active' => true,
            ],
        ];

        foreach ($schools as $school) {
            DB::table('medical_schools')->updateOrInsert(
                ['name' => $school['name']], // Prevent duplicates
                [
                    'country' => $school['country'],
                    'is_active' => $school['is_active'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );
        }
    }
}
