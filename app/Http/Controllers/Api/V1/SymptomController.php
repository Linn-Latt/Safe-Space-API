<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Symptom;
use Illuminate\Http\Request;

class SymptomController extends Controller
{
    public function index()
    {
        $symptoms = Symptom::cursorPaginate(10)->through(function ($symptom) {
            return [
                'id' => $symptom->id,
                'title' => $symptom->title,
            ];
        });

        $totalSymptoms = Symptom::count();

        return response()->json([
            'message' => 'Symptoms retrieved successfully',
            'status' => true,
            'data' => [
                'symptoms' => $symptoms->items(),
                'pagination' => [
                    'total' => $totalSymptoms,
                    'limit' => $symptoms->perPage(),
                    'next_cursor' => $symptoms->nextCursor()?->encode(),
                    'prev_cursor' => $symptoms->previousCursor()?->encode(),
                ],
            ],
        ], 200);
    }

    public function show($slug)
    {
        $symptom = Symptom::where('slug', $slug)->first();

        if (!$symptom) {
            return response()->json([
                'message' => 'Symptom not found',
                'status' => false,
            ], 404);
        }

        return response()->json([
            'message' => 'Symptom details retrieved successfully',
            'status' => true,
            'data' => [
                'id' => $symptom->id,
                'title' => $symptom->title,
                'slug' => $symptom->slug,
                'symptoms' => $symptom->symptoms,
            ],
        ], 200);
    }
}
