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
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        // Create account (password will be auto-hashed)
        $account = Account::create([
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => $data['role'],
        ]);

        // If registering a regular user
        if ($data['role'] === 'user') {
            User::create([
                'account_id' => $account->id,
                'nickname' => $data['nickname'],
                'anonymous' => false,
            ]);
        }

        // If registering a doctor
        if ($data['role'] === 'doctor') {
            // Handle certificate file upload
            $certificatePath = null;
            if ($request->hasFile('certificate')) {
                $certificatePath = $request->file('certificate')->store('certificates', 'public');
            }

            Doctor::create([
                'account_id' => $account->id,
                'name' => $data['name'],
                'license_number' => $data['license_number'],
                'certificate' => $certificatePath,
                'specialization' => $data['specialization'],
            ]);
        }

        return response()->json([
            'message' => 'Registration successful.',
            'account' => [
                'id' => $account->id,
                'email' => $account->email,
                'role' => $account->role,
            ]
        ], 201);
    }

    // Login
    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        $account = Account::where('email', $data['email'])->first();

        if (!$account || !Hash::check($data['password'], $account->password)) {
            return response()->json([
                'message' => 'Invalid credentials.'
            ], 401);
        }

        // Create Sanctum token
        $token = $account->createToken('auth-token')->plainTextToken;

        // Load user or doctor profile
        $profile = null;
        if ($account->role === 'user') {
            $profile = $account->user;
        } elseif ($account->role === 'doctor') {
            $profile = $account->doctor;
        }

        return response()->json([
            'message' => 'Login successful.',
            'token' => $token,
            'account' => [
                'id' => $account->id,
                'email' => $account->email,
                'role' => $account->role,
            ],
            'profile' => $profile,
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
