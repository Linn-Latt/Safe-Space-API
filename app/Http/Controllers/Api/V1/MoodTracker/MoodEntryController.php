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
            // 'timezone' =>  'required|timezone',
        ]);

        $accountId = $request->user()->id; 
        // $timezone = $request->timezone;
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
        $entry = MoodEntry::create([
            'account_id' => $accountId,
            'mood_score' => $request->mood_score,
            'mood_date'  => $today,
        ]);

        return response()->json([
            'message' => 'Your mood has been saved successfully.',
            'status' => true,
            'data' => [
                'mood_score' => $entry->mood_score,
                'mood_date' => $entry->mood_date,
            ],
        ], 201);
    }

    // Get daily mood history for a specific user
    public function getDailyMoodHistory(Request $request, $userId)
    {
        $moodEntries = MoodEntry::where('account_id', $userId)->orderBy('mood_date', 'desc')->get();

        if ($moodEntries->isEmpty()) {
            return response()->json([
                'message' => 'No mood entries found for this user.',
                'success' => false,
                'data' => [],
            ]);
        }

        return response()->json([
            'message' => 'User mood history retrieved successfully.',
            'success' => true,
            'data' => $moodEntries->map(function ($entry) {
                return [
                    'id' => $entry->id,
                    'mood_score' => $entry->mood_score,
                    'mood_date' => $entry->mood_date->format('Y-m-d'),
                    'created_at' => $entry->created_at,
                ];
            }),
        ], 200);
    }
}
