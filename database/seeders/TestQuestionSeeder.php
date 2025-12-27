<?php

namespace Database\Seeders;

use App\Models\Test;
use App\Models\TestQuestion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Depression Questions
        $depression = Test::where('type', 'depression')->first();
        $depressionQuestions = [
            "I have felt sad, empty, or hopeless most of the day, nearly every day.",
            "Things I usually enjoy have felt uninteresting or not worth the effort.",
            "I feel tired or drained even when I haven’t done much.",
            "I have had trouble sleeping, or I sleep much more than usual.",
            "I find it hard to concentrate, make decisions, or stay focused.",
            "I feel like I am a burden to others or that I let people down.",
            "My appetite has noticeably increased or decreased.",
            "I feel slowed down, or at times restless and unable to relax.",
            "I often feel guilty, worthless, or overly critical of myself.",
            "I have had thoughts that life is meaningless or that I would be better off not existing."
        ];

        foreach ($depressionQuestions as $index => $question) {
            TestQuestion::create([
                'test_id' => $depression->id,
                'question' => $question,
                'order_no' => $index + 1
            ]);
        }

        // Anxiety Questions
        $anxiety = Test::where('type', 'anxiety')->first();
        $anxietyQuestions = [
            "I feel nervous, on edge, or unable to relax most days.",
            "I worry about everyday situations, even when there is little reason to.",
            "My thoughts often race or get stuck on “what if” scenarios.",
            "I find it hard to control my worrying once it starts.",
            "I experience physical symptoms such as a racing heart, sweating, or stomach discomfort.",
            "I avoid certain situations or activities because they make me anxious.",
            "I feel restless, tense, or unable to sit still.",
            "I have trouble focusing because my mind is full of worries.",
            "I feel easily annoyed or overwhelmed because of anxiety.",
            "My anxiety makes daily life, work, or relationships harder."
        ];

        foreach ($anxietyQuestions as $index => $question) {
            TestQuestion::create([
                'test_id' => $anxiety->id,
                'question' => $question,
                'order_no' => $index + 1
            ]);
        }

        // Bipolar Questions
        $bipolar = Test::where('type', 'bipolar')->first();
        $bipolarQuestions = [
            "Sometimes I feel very happy or excited for several days in a row.",
            "During these times, I need much less sleep than usual.",
            "I talk much more or much faster than I normally do.",
            "I feel very confident, like I can do anything.",
            "I make quick or risky decisions during these high times.",
            "At other times, I feel very sad or empty for days or weeks.",
            "During low times, I feel tired and lose interest in things I like.",
            "My mood changes feel strong and hard to control.",
            "These mood changes cause problems in my daily life or relationships.",
            "People close to me notice big changes in my mood or behavior."
        ];

        foreach ($bipolarQuestions as $index => $question) {
            TestQuestion::create([
                'test_id' => $bipolar->id,
                'question' => $question,
                'order_no' => $index + 1
            ]);
        }
    }


}
