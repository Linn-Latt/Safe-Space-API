<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SymptomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('symptoms')->insert([
            [
                'title' => 'Anxiety',
                'slug' => 'anxiety',
                'symptoms' => json_encode([
                    "Constant worrying, even about small things",
                    "Feeling restless or unable to relax",
                    "Fast heartbeat or chest tightness",
                    "Sweating more than usual",
                    "Trouble concentrating",
                    "Feeling on edge all the time",
                    "Irritability",
                    "Muscle tension (especially neck and shoulders)",
                    "Stomach problems (nausea, diarrhea)",
                    "Trouble sleeping because your mind won’t stop thinking"
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'Depression',
                'slug' => 'depression',
                'symptoms' => json_encode([
                    "Feeling sad or empty most of the time",
                    "Losing interest in activities you used to enjoy",
                    "Low energy or constant tiredness",
                    "Sleeping too much or too little",
                    "Changes in appetite",
                    "Feeling worthless or guilty without clear reason",
                    "Difficulty concentrating or making decisions",
                    "Moving or speaking more slowly than usual",
                    "Feeling hopeless about the future",
                    "Thoughts of self-harm or suicide"
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'Bipolar Disorder',
                'slug' => 'bipolar-disorder',
                'symptoms' => json_encode([
                    "Deep sadness",
                    "Low energy",
                    "Loss of interest in activities",
                    "Sleeping too much or too little",
                    "Feelings of hopelessness",
                    "Thoughts of self-harm",
                    "Extremely high energy",
                    "Needing very little sleep but not feeling tired",
                    "Talking very fast or jumping between ideas",
                    "Feeling overly confident or powerful",
                    "Making risky decisions",
                    "Feeling unusually irritable or easily angered"
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'Stress & Burnout',
                'slug' => 'stress-burnout',
                'symptoms' => json_encode([
                    "Constant tiredness",
                    "Feeling overwhelmed",
                    "Losing motivation",
                    "Headaches or body aches",
                    "Irritability",
                    "Trouble sleeping",
                    "Feeling emotionally numb",
                    "Decreased work or school performance",
                    "Avoiding responsibilities",
                    "Feeling detached from work or people"
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'Panic Attacks',
                'slug' => 'panic-attacks',
                'symptoms' => json_encode([
                    "Sudden intense fear",
                    "Fast or pounding heartbeat",
                    "Shortness of breath",
                    "Chest pain",
                    "Feeling like you are choking",
                    "Dizziness or lightheadedness",
                    "Sweating",
                    "Shaking or trembling",
                    "Feeling like something terrible is about to happen",
                    "Fear of losing control or dying"
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'Sleep Problems',
                'slug' => 'sleep-problems',
                'symptoms' => json_encode([
                    "Difficulty falling asleep",
                    "Waking up many times during the night",
                    "Waking up too early",
                    "Feeling tired even after sleeping",
                    "Racing thoughts at bedtime",
                    "Nightmares",
                    "Using phone or devices late into the night",
                    "Feeling sleepy during the day"
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
