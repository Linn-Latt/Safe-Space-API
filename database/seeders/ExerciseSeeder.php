<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */public function run(): void
    {
        DB::table('exercises')->insert([
            [
                'type' => 'breathing',
                'title' => 'Calm Breathing',
                'description' => 'A short breathing exercise to help you calm your mind.',
                'duration' => 2,
                'exercise_steps' => json_encode([
                    'Sit comfortably and relax your shoulders.',
                    'Inhale slowly through your nose for 4 seconds.',
                    'Hold your breath for 2 seconds.',
                    'Exhale gently through your mouth for 6 seconds.',
                    'Repeat until 2 minutes are complete.'
                ]),
                'tips' => 'If your thoughts drift, gently bring your attention back to your breath.',
                'is_active' => true,
            ],
            [
                'type' => 'breathing',
                'title' => 'Box Breathing',
                'description' => 'A structured breathing technique to reduce stress and anxiety.',
                'duration' => 5,
                'exercise_steps' => json_encode([
                    'Inhale through your nose for 4 seconds.',
                    'Hold your breath for 4 seconds.',
                    'Exhale through your mouth for 4 seconds.',
                    'Hold your breath again for 4 seconds.',
                    'Repeat the cycle for 5 minutes.'
                ]),
                'tips' => 'Keep your breathing slow and steady.',
                'is_active' => true,
            ],
            [
                'type' => 'grounding',
                'title' => '5-4-3-2-1 Grounding Exercise',
                'description' => 'A grounding exercise to bring your attention to the present moment.',
                'duration' => 5,
                'exercise_steps' => json_encode([
                    'Name 5 things you can see around you.',
                    'Name 4 things you can feel or touch.',
                    'Name 3 things you can hear.',
                    'Name 2 things you can smell.',
                    'Name 1 thing you can taste.'
                ]),
                'tips' => 'Take your time with each step. There are no right or wrong answers.',
                'is_active' => true,
            ]
        ]);
    }
    
}
