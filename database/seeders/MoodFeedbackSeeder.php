<?php

namespace Database\Seeders;

use App\Models\MoodFeedback;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MoodFeedbackSeeder extends Seeder
{
    public function run(): void
    {
        MoodFeedback::insert([
            [
                'min_average_mood' => 1.0,
                'max_average_mood' => 2.0,
                'title' => 'A Tough Time',
                'feedback' => 'This week has been very difficult. Try to rest and talk to someone you trust.',
            ],
            [
                'min_average_mood' => 2.1,
                'max_average_mood' => 3.0,
                'title' => 'Feeling a Bit Low',
                'feedback' => 'You seem a little down this week. Small breaks and good sleep may help.',
            ],
            [
                'min_average_mood' => 3.1,
                'max_average_mood' => 4.0,
                'title' => 'Stable and Balanced',
                'feedback' => 'Your mood is fairly steady. Keep maintaining your daily routine.',
            ],
            [
                'min_average_mood' => 4.1,
                'max_average_mood' => 5.0,
                'title' => 'Feeling Positive',
                'feedback' => 'You are feeling positive this week. Keep up the good habits.',
            ],
        ]);
    }
}
