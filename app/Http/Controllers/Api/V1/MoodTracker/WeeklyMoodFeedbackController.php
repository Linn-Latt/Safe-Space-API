<?php

namespace App\Http\Controllers\Api\V1\MoodTracker;

use App\Models\WeeklyMoodFeedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MoodEntry;
use App\Models\MoodFeedback;

class WeeklyMoodFeedbackController extends Controller
{
    public function getWeeklyMoodFeedback(Request $request)
    {
        $accountId = $request->user()->id;

        // ISO week: Monday = day 1, Sunday = day 7
        $today = now();
        $dayOfWeek = (int) $today->format('N'); // 1 = Monday, 7 = Sunday
        $startDate = $today->copy()->subDays($dayOfWeek - 1)->toDateString();
        $endDate = $today->copy()->subDays($dayOfWeek - 1)->addDays(6)->toDateString();

        $entries = MoodEntry::where('account_id', $accountId)
            ->whereBetween('mood_date', [$startDate, $endDate])
            ->orderBy('mood_date')
            ->get();

        if ($entries->count() < 5) { 
            return response()->json([
                'message' => 'Not enough mood data for weekly analysis. Need at least 7 entries.',
                'debug' => [
                    'entries_found' => $entries->count(),
                    'date_range' => "$startDate to $endDate",
                    'entries' => $entries->pluck('mood_date')->toArray()
                ]
            ], 400);
        }

        $averageMood = round($entries->avg('mood_score'), 2);

        $feedback = MoodFeedback::where('min_average_mood', '<=', $averageMood)
            ->where('max_average_mood', '>=', $averageMood)
            ->first();

        if (!$feedback) {
            return response()->json([
                'message' => 'Weekly feedback not found for this mood average.',
                'success' => false,
            ], 404); 
        }

        // Prevent duplicate weekly result
        $alreadyExists = WeeklyMoodFeedback::where('account_id', $accountId)
            ->where('start_date', $startDate)
            ->where('end_date', $endDate)
            ->exists();

        if (!$alreadyExists) {
            WeeklyMoodFeedback::create([
                'account_id'       => $accountId,
                'mood_feedback_id' => $feedback->id,
                'start_date'       => $startDate,
                'end_date'         => $endDate,
                'average_mood'     => $averageMood,
            ]);
        }

        return response()->json([
            'message'=> 'Weekly mood feedback retrieved successfully.',
            'success' => true,
            'data' => [
                'week' => [ 
                    'start_date' => $startDate,
                    'end_date'   => $endDate,
                ],
                'average_mood' => $averageMood,
                'title'        => $feedback->title,
                'feedback'      => $feedback->feedback,
            ]
        ], 200);
    }

    // Get weekly mood history for a specific user
    public function getWeeklyMoodHistory(Request $request, $userId)
    {
        $weeklyResults = WeeklyMoodFeedback::with('feedback')
            ->where('account_id', $userId)
            ->orderBy('end_date', 'desc')
            ->get();

        if ($weeklyResults->isEmpty()) {
            return response()->json([
                'message' => 'No weekly mood results found for this user.',
                'success' => false,
                'data' => [],
            ], 404);
        }

        return response()->json([
            'message' => 'User weekly mood results retrieved successfully.',
            'success' => true,
            'data' => $weeklyResults->map(function ($result) {
                return [
                    'id' => $result->id,
                    'week' => [
                        'start_date' => $result->start_date->format('Y-m-d'),
                        'end_date' => $result->end_date->format('Y-m-d'),
                    ],
                    'average_mood' => $result->average_mood,
                    'title' => $result->feedback->title,
                    'feedback' => $result->feedback->feedback,
                    'created_at' => $result->created_at,
                ];
            }),
        ], 200);
    }
}
