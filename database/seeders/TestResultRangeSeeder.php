<?php

namespace Database\Seeders;

use App\Models\Test;
use App\Models\TestResultRange;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestResultRangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tests = Test::all();

        foreach ($tests as $test) {
            TestResultRange::insert([
                [
                    'test_id' => $test->id,
                    'label' => 'Low',
                    'min_score' => 0,
                    'max_score' => 3,
                    'feedback' => 'Your answers suggest few symptoms at this time. 
                        Keep taking care of your mental health and daily well-being.',
                ],
                [
                    'test_id' => $test->id,
                    'label' => 'Moderate',
                    'min_score' => 4,
                    'max_score' => 6,
                    'feedback' => 'Your answers show some signs that may be affecting your mood or stress levels.
                        Talking with a trusted person or monitoring your feelings may help. Consider professional advice if symptoms continue.',
                ],
                [
                    'test_id' => $test->id,
                    'label' => 'High',
                    'min_score' => 7,
                    'max_score' => 10,
                    'feedback' => 'Your answers suggest strong symptoms that may be impacting your daily life.
                        Reaching out to a mental health professional is strongly recommended.',
                ],
            ]);
        }
    }
}
