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

        $endDate = now()->toDateString();
        $startDate = now()->subDays(6)->toDateString();

        $entries = MoodEntry::where('account_id', $accountId)
            ->whereBetween('mood_date', [$startDate, $endDate])
            ->get();

        if ($entries->count() < 7) {
            return response()->json([
                'message' => 'Not enough mood data for weekly analysis.'
            ], 200);
        }

        $averageMood = round($entries->avg('mood_score'), 2);

        $feedback = MoodFeedback::where('min_average_mood', '<=', $averageMood)
            ->where('max_average_mood', '>=', $averageMood)
            ->first();

        if (!$feedback) {
            return response()->json([
                'message' => 'Weekly feedback not found.'
            ], 500);
        }

        // Prevent duplicate weekly result
        $alreadyExists = WeeklyMoodFeedback::where('account_id', $accountId)
            ->where('start_date', $startDate)
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
}
