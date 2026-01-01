<?php

namespace App\Http\Controllers\Api\V1\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function toggleAnonymous(Request $request)
    {
        $account = $request->user();    

        // Only regular users allowed to be anonymous
        if ($account->role !== 'user') {
            return response()->json([
                'message' => 'Only users can change anonymous setting.',
            ], 403);
        }

        $user = $account->user;
        $user->update([
            'anonymous' => !$user->anonymous,
        ]);
        $user->save();

        return response()->json([
            'message' => 'Anonymous setting updated successfully.',
            'success' => true,
            'data' => [
                'anonymous' => $user->anonymous,
            ],
        ], 200);
    }
}
