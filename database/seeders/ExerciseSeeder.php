<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExerciseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('exercises')->insert([
            [
                'type' => 'breathing',
                'title' => 'Calm Breathing',
                'title_mm' => 'ငြိမ်သက်သော အသက်ရှူလေ့ကျင့်ခန်း',
                'description' => 'A short breathing exercise to help calm your mind.',
                'description_mm' => 'သင့်စိတ်ကို ငြိမ်သက်စေရန် အကူအညီပေးသော အသက်ရှူလေ့ကျင့်ခန်းတိုတစ်ခု ဖြစ်ပါသည်။',
                'duration' => 2,
                'exercise_steps' => json_encode([
                    'Sit comfortably and relax your shoulders.',
                    'Inhale slowly through your nose for 4 seconds.',
                    'Hold your breath for 2 seconds.',
                    'Exhale gently through your mouth for 6 seconds.',
                    'Repeat until 2 minutes are completed.'
                ]),
                'exercise_steps_mm' => json_encode([
                    'သက်တောင့်သက်သာ ထိုင်ပြီး ပခုံးများကို အနားပေးပါ။',
                    'နှာခေါင်းမှတစ်ဆင့် ၄ စက္ကန့်ကြာ အသက်ရှူဝင်ပါ။',
                    '၂ စက္ကန့်ကြာ အသက်ကို ဆိုင်းထားပါ။',
                    'ပါးစပ်မှတစ်ဆင့် ၆ စက္ကန့်ကြာ အသက်ရှူထုတ်ပါ။',
                    '၂ မိနစ်ပြည့်သည်အထိ ထပ်ခါထပ်ခါ လုပ်ဆောင်ပါ။'
                ]),
                'tips' => 'If your thoughts drift, gently bring your focus back to your breathing.',
                'tips_mm' => 'သင့်အတွေးများ လွင့်သွားပါက အသက်ရှူမှုအပေါ်သို့ ပြန်လည်အာရုံစိုက်ပါ။',
                'is_active' => true,
            ],

            [
                'type' => 'breathing',
                'title' => 'Box Breathing',
                'title_mm' => 'Box အသက်ရှူလေ့ကျင့်ခန်း',
                'description' => 'A breathing technique used to reduce stress and improve focus.',
                'description_mm' => 'စိတ်ဖိစီးမှုကို လျော့ချပြီး အာရုံစိုက်နိုင်စွမ်းကို မြှင့်တင်ရန် အသုံးပြုသော အသက်ရှူနည်းတစ်ခု ဖြစ်သည်။',
                'duration' => 5,
                'exercise_steps' => json_encode([
                    'Inhale through your nose for 4 seconds.',
                    'Hold your breath for 4 seconds.',
                    'Exhale through your mouth for 4 seconds.',
                    'Hold your breath again for 4 seconds.',
                    'Repeat the cycle for 5 minutes.'
                ]),
                'exercise_steps_mm' => json_encode([
                    'နှာခေါင်းမှတစ်ဆင့် ၄ စက္ကန့်ကြာ အသက်ရှူဝင်ပါ။',
                    '၄ စက္ကန့်ကြာ အသက်ကို ဆိုင်းထားပါ။',
                    'ပါးစပ်မှတစ်ဆင့် ၄ စက္ကန့်ကြာ အသက်ရှူထုတ်ပါ။',
                    'ထပ်မံ၍ ၄ စက္ကန့်ကြာ အသက်ကို ဆိုင်းထားပါ။',
                    'ဤလည်ပတ်မှုကို ၅ မိနစ်ကြာအောင် ပြန်လုပ်ပါ။'
                ]),
                'tips' => 'Keep your breathing steady and relaxed.',
                'tips_mm' => 'အသက်ရှူမှုကို တည်ငြိမ်ပြီး သက်တောင့်သက်သာ ဖြစ်အောင် ထိန်းထားပါ။',
                'is_active' => true,
            ],

            [
                'type' => 'grounding',
                'title' => '5-4-3-2-1 Grounding',
                'title_mm' => '၅-၄-၃-၂-၁ အခြေခံစိတ်တည်ငြိမ်ရေး လေ့ကျင့်ခန်း',
                'description' => 'A grounding exercise to bring your attention to the present.',
                'description_mm' => 'လက်ရှိအချိန်တွင် အာရုံစိုက်နိုင်စေရန် ကူညီသော စိတ်တည်ငြိမ်ရေး လေ့ကျင့်ခန်းတစ်ခု ဖြစ်သည်။',
                'duration' => 5,
                'exercise_steps' => json_encode([
                    'Name 5 things you can see around you.',
                    'Name 4 things you can feel or touch.',
                    'Name 3 things you can hear.',
                    'Name 2 things you can smell.',
                    'Name 1 thing you can taste.'
                ]),
                'exercise_steps_mm' => json_encode([
                    'သင့်ပတ်ဝန်းကျင်တွင် မြင်နိုင်သော အရာ ၅ ခုကို ပြောပါ။',
                    'ထိတွေ့နိုင်သော သို့မဟုတ် ခံစားနိုင်သော အရာ ၄ ခုကို ပြောပါ။',
                    'ကြားနိုင်သော အသံ ၃ ခုကို ပြောပါ။',
                    'နံ့ခံနိုင်သော အရာ ၂ ခုကို ပြောပါ။',
                    'အရသာခံနိုင်သော အရာ ၁ ခုကို ပြောပါ။'
                ]),
                'tips' => 'Take your time with each step. There are no right or wrong answers.',
                'tips_mm' => 'အဆင့်တစ်ခုစီအတွက် အချိန်ယူပါ။ မှန်မှား မရှိပါ။',
                'is_active' => true,
            ]
        ]);
    }
}