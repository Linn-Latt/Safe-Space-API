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
            TestResultRange::where('test_id', $test->id)->delete();
            TestResultRange::insert([
                [
                    'test_id' => $test->id,
                    'label' => 'Low',
                    'label_mm' => 'နိမ့်',
                    'min_score' => 0,
                    'max_score' => 3,
                    'feedback' => 'Your answers suggest few symptoms at this time. Keep taking care of your mental health and daily well-being.',
                    'feedback_mm' => 'သင်၏အဖြေများသည် ယခုအချိန်တွင် လက္ခဏာအနည်းငယ်သာရှိကြောင်း ညွှန်ပြနေပါသည်။ သင်၏စိတ်ကျန်းမာရေးနှင့် နေ့စဉ်ကျန်းမာရေးကို ဆက်လက်ဂရုစိုက်ပါ။',
                ],
                [
                    'test_id' => $test->id,
                    'label' => 'Moderate',
                    'label_mm' => 'အလယ်အလတ်',
                    'min_score' => 4,
                    'max_score' => 6,
                    'feedback' => 'Your answers show some signs that may be affecting your mood or stress levels. Talking with a trusted person or monitoring your feelings may help. Consider professional advice if symptoms continue.',
                    'feedback_mm' => 'သင်၏အဖြေများသည် သင်၏စိတ်ခံစားမှု သို့မဟုတ် စိတ်ဖိစီးမှုအဆင့်ကို ထိခိုက်စေနိုင်သော လက္ခဏာအချို့ကို ပြသနေပါသည်။ ယုံကြည်ရသောလူတစ်ဦးနှင့် စကားပြောခြင်း သို့မဟုတ် သင်၏ခံစားချက်များကို စောင့်ကြည့်ခြင်းသည် အထောက်အကူဖြစ်နိုင်ပါသည်။ လက္ခဏာများ ဆက်လက်ဖြစ်ပေါ်ပါက ကျွမ်းကျင်သူ၏အကြံဉာဏ်ကို ထည့်သွင်းစဉ်းစားပါ။',
                ],
                [
                    'test_id' => $test->id,
                    'label' => 'High',
                    'label_mm' => 'မြင့်',
                    'min_score' => 7,
                    'max_score' => 10,
                    'feedback' => 'Your answers suggest strong symptoms that may be impacting your daily life. Reaching out to a mental health professional is strongly recommended.',
                    'feedback_mm' => 'သင်၏အဖြေများသည် သင်၏နေ့စဉ်ဘဝကို ထိခိုက်စေနိုင်သော ပြင်းထန်သောလက္ခဏာများကို ညွှန်ပြနေပါသည်။ စိတ်ကျန်းမာရေးကျွမ်းကျင်ပညာရှင်တစ်ဦးထံ ဆက်သွယ်ရန် အလေးအနက်အကြံပြုအပ်ပါသည်။',
                ],
            ]);
        }
    }
}
