<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Symptom;
use Illuminate\Http\Request;

class SymptomController extends Controller
{
    public function index()
    {
        $locale = app()->getLocale();
        
        $symptoms = Symptom::cursorPaginate(10)->through(function ($symptom) use ($locale) {
            return [
                'id' => $symptom->id,
                'title' => $locale === 'my' && $symptom->title_mm ? $symptom->title_mm : $symptom->title,
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
        $locale = app()->getLocale();
        
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
                'title' => $locale === 'my' && $symptom->title_mm ? $symptom->title_mm : $symptom->title,
                'slug' => $symptom->slug,
                'symptoms' => $locale === 'my' && $symptom->symptoms_mm ? $symptom->symptoms_mm : $symptom->symptoms,
            ],
        ], 200);
    }
}
