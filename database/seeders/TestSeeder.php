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
                'name_mm' => 'စိတ်ဓာတ်ကျရောဂါ',
                'type' => 'depression',
                'description' => 'Self-assessment for depression symptoms',
                'description_mm' => 'စိတ်ဓာတ်ကျရောဂါ လက္ခဏာများအတွက် မိမိကိုယ်ကို အကဲဖြတ်ခြင်း',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Anxiety Test',
                'name_mm' => 'စိုးရိမ်ပူပန်မှု',
                'type' => 'anxiety',
                'description' => 'Self-assessment for anxiety symptoms',
                'description_mm' => 'စိုးရိမ်ပူပန်မှု လက္ခဏာများအတွက် မိမိကိုယ်ကို အကဲဖြတ်ခြင်း',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bipolar Test',
                'name_mm' => 'စိတ်ခံစားမှု ပြောင်းလဲမှု',
                'type' => 'bipolar',
                'description' => 'Self-assessment for mood patterns',
                'description_mm' => 'စိတ်ခံစားမှု ပုံစံများအတွက် မိမိကိုယ်ကို အကဲဖြတ်ခြင်း',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
