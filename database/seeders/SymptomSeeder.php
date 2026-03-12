<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SymptomSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('symptoms')->insert([
            [
                'title' => 'Anxiety',
                'title_mm' => 'စိုးရိမ်ပူပန်မှု',
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
                    "Trouble sleeping because your mind won't stop thinking"
                ]),
                'symptoms_mm' => json_encode([
                    "သေးငယ်သောအရာများအတွက်ပင် အမြဲတမ်းစိုးရိမ်ပူပန်ခြင်း",
                    "မငြိမ်မသက်ဖြစ်ခြင်း သို့မဟုတ် အနားမယူနိုင်ခြင်း",
                    "နှလုံးခုန်မြန်ခြင်း သို့မဟုတ် ရင်ဘတ်တင်းမာခြင်း",
                    "ပုံမှန်ထက် ချွေးများစွာထွက်ခြင်း",
                    "အာရုံစူးစိုက်ရန် ခက်ခဲခြင်း",
                    "အမြဲတမ်း စိတ်လှုပ်ရှားနေခြင်း",
                    "စိတ်ဆိုးလွယ်ခြင်း",
                    "ကြွက်သားတင်းမာခြင်း (အထူးသဖြင့် လည်ပင်းနှင့် ပခုံး)",
                    "ဗိုက်ပြဿနာများ (ပျို့အန်ခြင်း၊ ဝမ်းလျှောခြင်း)",
                    "စိတ်မရပ်တန့်သောကြောင့် အိပ်ရေးပျက်ခြင်း"
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'Depression',
                'title_mm' => 'စိတ်ဓာတ်ကျရောဂါ',
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
                'symptoms_mm' => json_encode([
                    "အချိန်အများစုတွင် ဝမ်းနည်းခြင်း သို့မဟုတ် ဗလာဖြစ်ခြင်း",
                    "ယခင်က နှစ်သက်ခဲ့သော လုပ်ဆောင်ချက်များအပေါ် စိတ်ဝင်စားမှုဆုံးရှုံးခြင်း",
                    "စွမ်းအင်နည်းခြင်း သို့မဟုတ် အမြဲတမ်းပင်ပန်းခြင်း",
                    "အလွန်များစွာအိပ်ခြင်း သို့မဟုတ် အလွန်နည်းပါးအိပ်ခြင်း",
                    "အစားအသောက်စားချင်စိတ် ပြောင်းလဲခြင်း",
                    "ရှင်းလင်းသောအကြောင်းပြချက်မရှိဘဲ တန်ဖိုးမရှိသည်ဟု သို့မဟုတ် အပြစ်ရှိသည်ဟု ခံစားခြင်း",
                    "အာရုံစူးစိုက်ရန် သို့မဟုတ် ဆုံးဖြတ်ချက်ချရန် ခက်ခဲခြင်း",
                    "ပုံမှန်ထက် ပိုမိုနှေးကွေးစွာ လှုပ်ရှားခြင်း သို့မဟုတ် ပြောဆိုခြင်း",
                    "အနာဂတ်အတွက် မျှော်လင့်ချက်မရှိဟု ခံစားခြင်း",
                    "မိမိကိုယ်ကို ထိခိုက်စေခြင်း သို့မဟုတ် သေသည်ဟု အတွေးများ"
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'Bipolar Disorder',
                'title_mm' => 'စိတ်ခံစားမှု ပြောင်းလဲရောဂါ',
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
                'symptoms_mm' => json_encode([
                    "နက်ရှိုင်းသော ဝမ်းနည်းခြင်း",
                    "စွမ်းအင်နည်းခြင်း",
                    "လုပ်ဆောင်ချက်များအပေါ် စိတ်ဝင်စားမှုဆုံးရှုံးခြင်း",
                    "အလွန်များစွာအိပ်ခြင်း သို့မဟုတ် အလွန်နည်းပါးအိပ်ခြင်း",
                    "မျှော်လင့်ချက်မရှိဟု ခံစားခြင်း",
                    "မိမိကိုယ်ကို ထိခိုက်စေသည့် အတွေးများ",
                    "အလွန်မြင့်မားသော စွမ်းအင်",
                    "အိပ်စက်ရန် အလွန်နည်းပါးလိုအပ်သော်လည်း ပင်ပန်းမှုမခံစားရခြင်း",
                    "အလွန်မြန်မြန်ပြောဆိုခြင်း သို့မဟုတ် အတွေးများကြား ခုန်ပေါက်ခြင်း",
                    "အလွန်အမင်း ယုံကြည်မှုရှိခြင်း သို့မဟုတ် အင်အားကြီးသည်ဟု ခံစားခြင်း",
                    "အန္တရာယ်ရှိသော ဆုံးဖြတ်ချက်များချခြင်း",
                    "ပုံမှန်မဟုတ်စွာ စိတ်ဆိုးလွယ်ခြင်း သို့မဟုတ် အလွယ်တကူ ဒေါသထွက်ခြင်း"
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'Stress & Burnout',
                'title_mm' => 'စိတ်ဖိစီးမှုနှင့် ကုန်ခမ်းမှု',
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
                'symptoms_mm' => json_encode([
                    "အမြဲတမ်း ပင်ပန်းခြင်း",
                    "ဖိစီးမှုခံရသည်ဟု ခံစားခြင်း",
                    "လှုံ့ဆော်မှုဆုံးရှုံးခြင်း",
                    "ခေါင်းကိုက်ခြင်း သို့မဟုတ် ကိုယ်ခန္ဓာကိုက်ခဲခြင်း",
                    "စိတ်ဆိုးလွယ်ခြင်း",
                    "အိပ်ရေးပျက်ခြင်း",
                    "စိတ်ခံစားမှုမရှိဟု ခံစားခြင်း",
                    "အလုပ် သို့မဟုတ် ကျောင်းစွမ်းဆောင်ရည် ကျဆင်းခြင်း",
                    "တာဝန်များကို ရှောင်ကြဉ်ခြင်း",
                    "အလုပ် သို့မဟုတ် လူများနှင့် ကွာဟသည်ဟု ခံစားခြင်း"
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'Panic Attacks',
                'title_mm' => 'ထိတ်လန့်တုန်လှုပ်မှု',
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
                'symptoms_mm' => json_encode([
                    "ရုတ်တရက် ပြင်းထန်သော ကြောက်ရွံ့ခြင်း",
                    "နှလုံးခုန်မြန်ခြင်း သို့မဟုတ် ပြင်းထန်စွာခုန်ခြင်း",
                    "အသက်ရှူကြပ်ခြင်း",
                    "ရင်ဘတ်နာကျင်ခြင်း",
                    "လည်ချောင်းပိတ်သွားသည်ဟု ခံစားခြင်း",
                    "ခေါင်းမူးခြင်း သို့မဟုတ် ခေါင်းပေါ့ခြင်း",
                    "ချွေးထွက်ခြင်း",
                    "တုန်ခါခြင်း သို့မဟုတ် တုန်လှုပ်ခြင်း",
                    "ဆိုးရွားသောအရာတစ်ခုခု ဖြစ်တော့မည်ဟု ခံစားခြင်း",
                    "ထိန်းချုပ်မှုဆုံးရှုံးမည် သို့မဟုတ် သေမည်ဟု ကြောက်ရွံ့ခြင်း"
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'Sleep Problems',
                'title_mm' => 'အိပ်စက်ခြင်းဆိုင်ရာ ပြဿနာများ',
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
                'symptoms_mm' => json_encode([
                    "အိပ်ရန် ခက်ခဲခြင်း",
                    "ညဘက်တွင် အကြိမ်များစွာ နိုးလာခြင်း",
                    "အလွန်စောစီးစွာ နိုးလာခြင်း",
                    "အိပ်ပြီးနောက်တွင်ပင် ပင်ပန်းနေခြင်း",
                    "အိပ်ချိန်တွင် အတွေးများ မြန်မြန်ပြေးခြင်း",
                    "အိပ်မက်ဆိုးများ",
                    "ညနက်ပိုင်းအထိ ဖုန်း သို့မဟုတ် စက်ပစ္စည်းများ အသုံးပြုခြင်း",
                    "နေ့ဘက်တွင် အိပ်ငိုက်မိခြင်း"
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}