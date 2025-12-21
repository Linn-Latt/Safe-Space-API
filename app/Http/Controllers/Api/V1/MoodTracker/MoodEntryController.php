<?php

namespace App\Http\Controllers\Api\V1\MoodTracker;
use App\Http\Controllers\Controller;
use App\Models\MoodEntry;
use Illuminate\Http\Request;

class MoodEntryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'mood_score' => 'required|integer|min:1|max:5',
        ]);

        $accountId = $request->user()->id; // Fixed: use ->id instead of ->account_id
        $today = now()->toDateString();

        // Check if mood already tracked today
        $alreadyTracked = MoodEntry::where('account_id', $accountId)
            ->where('mood_date', $today)
            ->exists();

        if ($alreadyTracked) {
            return response()->json([
                'message' => 'You have already tracked your mood today.'
            ], 409);
        }

        // Save mood entry
        MoodEntry::create([
            'account_id' => $accountId,
            'mood_score' => $request->mood_score,
            'mood_date'  => $today,
        ]);

        return response()->json([
            'message' => 'Your mood has been saved successfully.'
        ], 201);
    }
}
