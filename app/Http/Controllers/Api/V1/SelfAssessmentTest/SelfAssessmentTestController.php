<?php

namespace App\Http\Controllers\Api\v1\SelfAssessmentTest;

use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\TestAnswer;
use App\Models\TestAttempt;
use App\Models\TestResultRange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class SelfAssessmentTestController extends Controller
{
    public function getTests()
    {
        $locale = app()->getLocale();
        
        $tests = Test::select('id', 'name', 'name_mm', 'type', 'description', 'description_mm')
            ->get()
            ->map(function ($test) use ($locale) {
                return [
                    'id' => $test->id,
                    'name' => $locale === 'my' && $test->name_mm ? $test->name_mm : $test->name,
                    'type' => $test->type,
                    'description' => $locale === 'my' && $test->description_mm ? $test->description_mm : $test->description,
                ];
            });

        return response()->json([
            'message' => 'Tests retrieved successfully.',
            'success' => true,
            'data' => $tests,
        ], 200);
    }

    // Get Test Questions
    public function getTestQuestions(Test $test)
    {
        $locale = app()->getLocale();
        
        $questions = $test->questions()
            ->select('id', 'question', 'question_mm')
            ->orderBy('order_no', 'asc')
            ->get()
            ->map(function ($question) use ($locale) {
                return [
                    'id' => $question->id,
                    'question' => $locale === 'my' && $question->question_mm ? $question->question_mm : $question->question,
                ];
            });

        return response()->json([
            'message' => 'Questions retrieved successfully.',
            'success' => true,
            'data' => [
                'test' => [
                    'id' => $test->id,
                    'name' => $locale === 'my' && $test->name_mm ? $test->name_mm : $test->name,
                    'type' => $test->type,
                ],
                'questions' => $questions,
            ],
        ], 200);
    }

    // Submit Test Answers and Get Results
    public function submitTestAnswers(Request $request, Test $test)
    {
        $request->validate([
            'answers' => 'required|array',
            'answers.*.question_id' => 'required|exists:test_questions,id',
            'answers.*.answer' => 'required|boolean',
        ]);

        return DB::transaction(function () use ($request, $test) {
            $locale = app()->getLocale();
            $userId = $request->user()->id;
            $answers = $request->answers;

            $attempt = TestAttempt::create([
                'account_id' => $userId,
                'test_id' => $test->id,
            ]);

            $totalScore = $this->calculateScore($attempt->id, $answers);

            $resultRange = $this->resolveResultRange($test->id, $totalScore);

            $attempt->update([
                'total_score' => $totalScore,
                'result_label' => $locale === 'my' && $resultRange->label_mm ? $resultRange->label_mm : $resultRange->label,
            ]);

            return response()->json([
                'message' => 'Test completed successfully.',
                'success' => true,
                'data' => [
                    'attempt_id' => $attempt->id,
                    'total_score' => $totalScore,
                    'result_label' => $locale === 'my' && $resultRange->label_mm ? $resultRange->label_mm : $resultRange->label,
                    'feedback' => $locale === 'my' && $resultRange->feedback_mm ? $resultRange->feedback_mm : $resultRange->feedback,
                    'test' => [
                        'name' => $locale === 'my' && $test->name_mm ? $test->name_mm : $test->name,
                        'type' => $test->type,
                    ],
                ],
            ], 201);
        });
    }

    private function calculateScore(int $attemptId, array $answers): int 
    {
        $score = 0;

        foreach($answers as $answer) {
            TestAnswer::create([
                'test_attempt_id' => $attemptId,
                'test_question_id' => $answer['question_id'],
                'answer' => $answer['answer'],
            ]);

            if ($answer['answer']) {
                $score++;
            }
        }
        return $score;
    }

    private function resolveResultRange(int $testId, int $score): TestResultRange
    {
        $range = TestResultRange::where('test_id', $testId)
            ->where('min_score', '<=', $score)
            ->where('max_score', '>=', $score)
            ->first();
        
        if (! $range) {
            throw new RuntimeException('Unable to determine test result.');
        }

        return $range;
    }

    // Get specific test result by attempt ID
    public function getTestResult(Request $request, TestAttempt $attempt)
    {
        // Check if this attempt belongs to the authenticated user
        if ($attempt->account_id !== $request->user()->id) {
            return response()->json([
                'message' => 'Unauthorized access to test results.',
                'success' => false,
            ], 403);
        }

        $locale = app()->getLocale();
        
        // Get the result range for feedback
        $resultRange = $this->resolveResultRange($attempt->test_id, $attempt->total_score);

        return response()->json([
            'message' => 'Test result retrieved successfully.',
            'success' => true,
            'data' => [
                'attempt_id' => $attempt->id,
                'total_score' => $attempt->total_score,
                'result_label' => $locale === 'my' && $resultRange->label_mm ? $resultRange->label_mm : $resultRange->label,
                'feedback' => $locale === 'my' && $resultRange->feedback_mm ? $resultRange->feedback_mm : $resultRange->feedback,
                'test' => [
                    'id' => $attempt->test->id,
                    'name' => $locale === 'my' && $attempt->test->name_mm ? $attempt->test->name_mm : $attempt->test->name,
                    'type' => $attempt->test->type,
                ],
                'completed_at' => $attempt->created_at,
            ],
        ], 200);
    }

    // Get all test attempts for the authenticated user
    public function getUserTestHistory(Request $request)
    {
        $locale = app()->getLocale();
        
        $attempts = TestAttempt::where('account_id', $request->user()->id)
            ->with(['test:id,name,name_mm,type'])
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($attempt) use ($locale) {
                $resultRange = $this->resolveResultRange($attempt->test_id, $attempt->total_score);
                
                return [
                    'attempt_id' => $attempt->id,
                    'total_score' => $attempt->total_score,
                    'result_label' => $locale === 'my' && $resultRange->label_mm ? $resultRange->label_mm : $resultRange->label,
                    'feedback' => $locale === 'my' && $resultRange->feedback_mm ? $resultRange->feedback_mm : $resultRange->feedback,
                    'test' => [
                        'name' => $locale === 'my' && $attempt->test->name_mm ? $attempt->test->name_mm : $attempt->test->name,
                        'type' => $attempt->test->type,
                    ],
                    'date' => $attempt->created_at->format('Y-m-d'),
                ];
            });

        return response()->json([
            'message' => 'Test history retrieved successfully.',
            'success' => true,
            'data' => $attempts,
        ], 200);
    }

    
}
