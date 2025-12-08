<?php

namespace App\Http\Controllers\Api\V1\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Authentication\LoginRequest;
use App\Http\Requests\V1\Authentication\RegisterRequest;
use App\Models\Account;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function register(RegisterRequest $registerRequest)
    {
        $registerRequest->validate([
            'role' => 'required|in:user,doctor',

            'email' => 'required|email|unique:accounts,email',
            'password' => 'required|min:6',

            // Regular user fields
            'nickname' => 'required_if:role,user',

            // Doctor fields
            'name' => 'required_if:role,doctor',
            'license_number' => 'required_if:role,doctor',
            'certificate' => 'required_if:role,doctor|file|mimes:pdf,jpg,png',
            'specialization' => 'required_if:role,doctor',
        ]);

        // Create account
        $account = Account::create([
            'email' => $registerRequest->email,
            'password' => $registerRequest->password,
            'role' => $registerRequest->role,
        ]);

        // If registering a regular user
        if ($registerRequest->role === 'user') {
            User::create([
                'account_id' => $account->id,
                'nickname' => $registerRequest->nickname,
                'anonymous' => false,
            ]);
        }

        // If registering a doctor
        if ($registerRequest->role === 'doctor') {
            Doctor::create([
                'account_id' => $account->id,
                'name' => $registerRequest->name,
                'license_number' => $registerRequest->license_number,
                'certificate' => $registerRequest->certificate,
                'specialization' => $registerRequest->specialization,
            ]);
        }

        return response()->json([
            'message' => 'Registration successful.'
        ], 201);
    }

    // Login
    public function login(LoginRequest $loginRequest)
    {
        $data = $loginRequest->validated();

        $account = Account::where('email', $data['email'])->first();

        if (!$account || !Hash::check($data['password'], $account->password)) {
            return response()->json([
                'message' => 'Invalid credentials.'
            ], 401);
        }

        // Create Sanctum token
        $token = $account->createToken('auth-token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful.',
            'token' => $token,
        ], 200);
    }

    // Logout
    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout successful.'
        ], 200);
    }
}
