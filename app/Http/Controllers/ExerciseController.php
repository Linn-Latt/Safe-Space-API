<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function index()
    {
        $exercises = Exercise::cursorPaginate(10)->through(function ($exercise) {
            return [
                'id' => $exercise->id,
                'title' => $exercise->title,
                'description' => $exercise->description,
                'exercise_steps' => $exercise->exercise_steps,
                'tips' => $exercise->tips,
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
