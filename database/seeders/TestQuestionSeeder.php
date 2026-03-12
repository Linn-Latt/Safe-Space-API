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
            [
                'en' => "I have felt sad, empty, or hopeless most of the day, nearly every day.",
                'mm' => "ကျွန်တော်/ကျွန်မ နေ့တိုင်း၊ တစ်နေ့လုံးနီးပါး ဝမ်းနည်းခြင်း၊ ဗလာဖြစ်ခြင်း သို့မဟုတ် မျှော်လင့်ချက်မဲ့ခြင်းကို ခံစားခဲ့ရပါသည်။"
            ],
            [
                'en' => "Things I usually enjoy have felt uninteresting or not worth the effort.",
                'mm' => "ကျွန်တော်/ကျွန်မ ပုံမှန်နှစ်သက်သော အရာများသည် စိတ်မဝင်စားဖွယ် သို့မဟုတ် ကြိုးစားရန် မထိုက်တန်ဟု ခံစားရပါသည်။"
            ],
            [
                'en' => "I feel tired or drained even when I haven't done much.",
                'mm' => "ကျွန်တော်/ကျွန်မ များစွာမလုပ်ရသော်လည်း ပင်ပန်းခြင်း သို့မဟုတ် စွမ်းအင်ကုန်ခြင်းကို ခံစားရပါသည်။"
            ],
            [
                'en' => "I have had trouble sleeping, or I sleep much more than usual.",
                'mm' => "ကျွန်တော်/ကျွန်မ အိပ်ရေးပျက်ခြင်း သို့မဟုတ် ပုံမှန်ထက် များစွာအိပ်ခြင်းကို ကြုံတွေ့ရပါသည်။"
            ],
            [
                'en' => "I find it hard to concentrate, make decisions, or stay focused.",
                'mm' => "ကျွန်တော်/ကျွန်မ အာရုံစူးစိုက်ရန်၊ ဆုံးဖြတ်ချက်ချရန် သို့မဟုတ် အာရုံစိုက်ထားရန် ခက်ခဲပါသည်။"
            ],
            [
                'en' => "I feel like I am a burden to others or that I let people down.",
                'mm' => "ကျွန်တော်/ကျွန်မ သည် အခြားသူများအတွက် ဝန်ထုပ်ဝန်ပိုးဖြစ်သည် သို့မဟုတ် လူများကို စိတ်ပျက်စေသည်ဟု ခံစားရပါသည်။"
            ],
            [
                'en' => "My appetite has noticeably increased or decreased.",
                'mm' => "ကျွန်တော်/ကျွန်မ၏ အစားအသောက်စားချင်စိတ် သိသိသာသာ တိုးလာခြင်း သို့မဟုတ် လျော့ကျခြင်းရှိပါသည်။"
            ],
            [
                'en' => "I feel slowed down, or at times restless and unable to relax.",
                'mm' => "ကျွန်တော်/ကျွန်မ နှေးကွေးသွားသည်ဟု ခံစားရပါသည် သို့မဟုတ် တစ်ခါတစ်ရံ မငြိမ်မသက်ဖြစ်ပြီး အနားမယူနိုင်ပါ။"
            ],
            [
                'en' => "I often feel guilty, worthless, or overly critical of myself.",
                'mm' => "ကျွန်တော်/ကျွန်မ မကြာခဏ အပြစ်ရှိသည်ဟု၊ တန်ဖိုးမရှိဟု သို့မဟုတ် မိမိကိုယ်ကို အလွန်အမင်း ဝေဖန်သည်ဟု ခံစားရပါသည်။"
            ],
            [
                'en' => "I have had thoughts that life is meaningless or that I would be better off not existing.",
                'mm' => "ကျွန်တော်/ကျွန်မ ဘဝသည် အဓိပ္ပာယ်မရှိဟု သို့မဟုတ် မရှိတော့လျှင် ပိုကောင်းမည်ဟု အတွေးများရှိခဲ့ပါသည်။"
            ]
        ];

        foreach ($depressionQuestions as $index => $question) {
            TestQuestion::create([
                'test_id' => $depression->id,
                'question' => $question['en'],
                'question_mm' => $question['mm'],
                'order_no' => $index + 1
            ]);
        }

        // Anxiety Questions
        $anxiety = Test::where('type', 'anxiety')->first();
        $anxietyQuestions = [
            [
                'en' => "I feel nervous, on edge, or unable to relax most days.",
                'mm' => "ကျွန်တော်/ကျွန်မ နေ့အများစုတွင် စိတ်လှုပ်ရှားခြင်း၊ စိတ်မငြိမ်ခြင်း သို့မဟုတ် အနားမယူနိုင်ခြင်းကို ခံစားရပါသည်။"
            ],
            [
                'en' => "I worry about everyday situations, even when there is little reason to.",
                'mm' => "ကျွန်တော်/ကျွန်မ အကြောင်းပြချက်နည်းနည်းသာရှိသော်လည်း နေ့စဉ်အခြေအနေများအတွက် စိုးရိမ်ပူပန်ပါသည်။"
            ],
            [
                'en' => "My thoughts often race or get stuck on 'what if' scenarios.",
                'mm' => "ကျွန်တော်/ကျွန်မ၏ အတွေးများသည် မကြာခဏ 'ဘာဖြစ်မလဲ' ဆိုသော အခြေအနေများတွင် ပိတ်မိနေပါသည်။"
            ],
            [
                'en' => "I find it hard to control my worrying once it starts.",
                'mm' => "ကျွန်တော်/ကျွန်မ စိုးရိမ်ပူပန်မှု စတင်သည်နှင့် ထိန်းချုပ်ရန် ခက်ခဲပါသည်။"
            ],
            [
                'en' => "I experience physical symptoms such as a racing heart, sweating, or stomach discomfort.",
                'mm' => "ကျွန်တော်/ကျွန်မ နှလုံးခုန်မြန်ခြင်း၊ ချွေးထွက်ခြင်း သို့မဟုတ် ဗိုက်အနှောင့်အယှက်ကဲ့သို့ ရုပ်ပိုင်းဆိုင်ရာ လက္ခဏာများကို ကြုံတွေ့ရပါသည်။"
            ],
            [
                'en' => "I avoid certain situations or activities because they make me anxious.",
                'mm' => "ကျွန်တော်/ကျွန်မ စိုးရိမ်ပူပန်မှုဖြစ်စေသောကြောင့် အချို့သော အခြေအနေများ သို့မဟုတ် လုပ်ဆောင်ချက်များကို ရှောင်ကြဉ်ပါသည်။"
            ],
            [
                'en' => "I feel restless, tense, or unable to sit still.",
                'mm' => "ကျွန်တော်/ကျွန်မ မငြိမ်မသက်ဖြစ်ခြင်း၊ တင်းမာခြင်း သို့မဟုတ် ငြိမ်ငြိမ်မထိုင်နိုင်ခြင်းကို ခံစားရပါသည်။"
            ],
            [
                'en' => "I have trouble focusing because my mind is full of worries.",
                'mm' => "ကျွန်တော်/ကျွန်မ၏ စိတ်သည် စိုးရိမ်ပူပန်မှုများနှင့် ပြည့်နှက်နေသောကြောင့် အာရုံစူးစိုက်ရန် ခက်ခဲပါသည်။"
            ],
            [
                'en' => "I feel easily annoyed or overwhelmed because of anxiety.",
                'mm' => "ကျွန်တော်/ကျွန်မ စိုးရိမ်ပူပန်မှုကြောင့် အလွယ်တကူ စိတ်ဆိုးခြင်း သို့မဟုတ် ဖိစီးမှုခံရခြင်းကို ခံစားရပါသည်။"
            ],
            [
                'en' => "My anxiety makes daily life, work, or relationships harder.",
                'mm' => "ကျွန်တော်/ကျွန်မ၏ စိုးရိမ်ပူပန်မှုသည် နေ့စဉ်ဘဝ၊ အလုပ် သို့မဟုတ် ဆက်ဆံရေးများကို ပိုမိုခက်ခဲစေပါသည်။"
            ]
        ];

        foreach ($anxietyQuestions as $index => $question) {
            TestQuestion::create([
                'test_id' => $anxiety->id,
                'question' => $question['en'],
                'question_mm' => $question['mm'],
                'order_no' => $index + 1
            ]);
        }

        // Bipolar Questions
        $bipolar = Test::where('type', 'bipolar')->first();
        $bipolarQuestions = [
            [
                'en' => "Sometimes I feel very happy or excited for several days in a row.",
                'mm' => "တစ်ခါတစ်ရံ ကျွန်တော်/ကျွန်မ ဆက်တိုက်ရက်ပေါင်းများစွာ အလွန်ပျော်ရွှင်ခြင်း သို့မဟုတ် စိတ်လှုပ်ရှားခြင်းကို ခံစားရပါသည်။"
            ],
            [
                'en' => "During these times, I need much less sleep than usual.",
                'mm' => "ဤအချိန်များတွင် ကျွန်တော်/ကျွန်မ ပုံမှန်ထက် အိပ်စက်ရန် များစွာနည်းပါးသည်။"
            ],
            [
                'en' => "I talk much more or much faster than I normally do.",
                'mm' => "ကျွန်တော်/ကျွန်မ ပုံမှန်ထက် များစွာပိုပြောခြင်း သို့မဟုတ် များစွာမြန်မြန်ပြောခြင်းကို ပြုလုပ်ပါသည်။"
            ],
            [
                'en' => "I feel very confident, like I can do anything.",
                'mm' => "ကျွန်တော်/ကျွန်မ အလွန်ယုံကြည်မှုရှိသည်ဟု ခံစားရပြီး မည်သည့်အရာမဆို လုပ်နိုင်သည်ဟု ထင်ပါသည်။"
            ],
            [
                'en' => "I make quick or risky decisions during these high times.",
                'mm' => "ကျွန်တော်/ကျွန်မ ဤမြင့်မားသောအချိန်များတွင် လျင်မြန်သော သို့မဟုတ် အန္တရာယ်ရှိသော ဆုံးဖြတ်ချက်များချပါသည်။"
            ],
            [
                'en' => "At other times, I feel very sad or empty for days or weeks.",
                'mm' => "အခြားအချိန်များတွင် ကျွန်တော်/ကျွန်မ ရက်ပေါင်းများစွာ သို့မဟုတ် ရက်သတ္တပတ်များစွာ အလွန်ဝမ်းနည်းခြင်း သို့မဟုတ် ဗလာဖြစ်ခြင်းကို ခံစားရပါသည်။"
            ],
            [
                'en' => "During low times, I feel tired and lose interest in things I like.",
                'mm' => "နိမ့်ကျသောအချိန်များတွင် ကျွန်တော်/ကျွန်မ ပင်ပန်းခြင်းနှင့် ကြိုက်နှစ်သက်သောအရာများအပေါ် စိတ်ဝင်စားမှုဆုံးရှုံးခြင်းကို ခံစားရပါသည်။"
            ],
            [
                'en' => "My mood changes feel strong and hard to control.",
                'mm' => "ကျွန်တော်/ကျွန်မ၏ စိတ်ခံစားမှုပြောင်းလဲမှုများသည် ပြင်းထန်ပြီး ထိန်းချုပ်ရန် ခက်ခဲပါသည်။"
            ],
            [
                'en' => "These mood changes cause problems in my daily life or relationships.",
                'mm' => "ဤစိတ်ခံစားမှုပြောင်းလဲမှုများသည် ကျွန်တော်/ကျွန်မ၏ နေ့စဉ်ဘဝ သို့မဟုတ် ဆက်ဆံရေးများတွင် ပြဿနာများဖြစ်စေပါသည်။"
            ],
            [
                'en' => "People close to me notice big changes in my mood or behavior.",
                'mm' => "ကျွန်တော်/ကျွန်မနှင့် နီးစပ်သောလူများသည် ကျွန်တော်/ကျွန်မ၏ စိတ်ခံစားမှု သို့မဟုတ် အပြုအမူတွင် ကြီးမားသောပြောင်းလဲမှုများကို သတိပြုမိပါသည်။"
            ]
        ];

        foreach ($bipolarQuestions as $index => $question) {
            TestQuestion::create([
                'test_id' => $bipolar->id,
                'question' => $question['en'],
                'question_mm' => $question['mm'],
                'order_no' => $index + 1
            ]);
        }
    }


}
