<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function index()
    {
        $locale = app()->getLocale();
        
        $exercises = Exercise::cursorPaginate(10)->through(function ($exercise) use ($locale) {
            return [
                'id' => $exercise->id,
                'title' => $locale === 'my' && $exercise->title_mm ? $exercise->title_mm : $exercise->title,
                'description' => $locale === 'my' && $exercise->description_mm ? $exercise->description_mm : $exercise->description,
                'exercise_steps' => $locale === 'my' && $exercise->exercise_steps_mm ? $exercise->exercise_steps_mm : $exercise->exercise_steps,
                'tips' => $locale === 'my' && $exercise->tips_mm ? $exercise->tips_mm : $exercise->tips,
            ];
        });

        $totalExercises = Exercise::count();
        
        return response()->json([
            'message' => 'Exercises retrieved successfully',
            'status' => true,
            'data' => [
                'exercises' => $exercises->items(),
                'pagination' => [
                    'total' => $totalExercises,
                    'limit' => $exercises->perPage(),
                    'next_cursor' => $exercises->nextCursor()?->encode(),
                    'prev_cursor' => $exercises->previousCursor()?->encode(),
                ],
            ],
        ], 200);
    }
}
