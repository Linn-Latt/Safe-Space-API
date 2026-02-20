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

        $profile = null;

        // If registering a regular user
        if ($data['role'] === 'user') {
            User::create([
                'account_id' => $account->id,
                'nickname' => $data['nickname'],
                'anonymous' => false,
            ]);

            $profile = $account->user;
        }

        // If registering a doctor
        if ($data['role'] === 'doctor') {
            // Validate credentials
            $credentialsValid = $this->validateDoctorCredentials($data);
            
            if (!$credentialsValid) {
                return response()->json([
                    'message' => 'Registration failed. Invalid credentials provided.',
                    'errors' => [
                        'credentials' => ['The provided medical credentials could not be verified.']
                    ]
                ], 422);
            }

            Doctor::create([
                'account_id' => $account->id,
                'name' => $data['name'],
                'medical_degree' => $data['medical_degree'],
                'medical_school_id' => $data['medical_school_id'],
                'graduation_year' => $data['graduation_year'],
                'specialization' => $data['specialization'],
                'license_number' => $data['license_number'],
                'license_expiry_date' => $data['license_expiry_date'],
                'license_authority' => $data['license_authority'] ?? 'Myanmar Medical Council',
                'years_of_experience' => $data['years_of_experience'],
                'is_currently_practicing' => $data['is_currently_practicing'],
                'practice_city' => $data['practice_city'],
                'practice_state' => $data['practice_state'],
                'clinic_name' => $data['clinic_name'] ?? null,
                'clinic_registration_number' => $data['clinic_registration_number'] ?? null,
                'professional_memberships' => $data['professional_memberships'] ?? null,
                'credentials_confirmed' => true,
            ]);

            $profile = $account->doctor;
        }

        // Generate token immediately
        $token = $account->createToken('auth-token')->plainTextToken;

        return response()->json([
            'message' => 'Registration successful.',
            'token' => $token,
            'account' => [
                'id' => $account->id,
                'email' => $account->email,
                'role' => $account->role,
            ],
            'profile' => $profile,
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
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout successful.'
        ], 200);
    }

    // Get current authenticated user info
    public function me(Request $request)
    {
        $account = $request->user();
        $profile = null;
        
        if ($account->role === 'user') {
            $profile = $account->user;
        } elseif ($account->role === 'doctor') {
            $profile = $account->doctor;
        }
        
        return response()->json([
            'account' => [
                'id' => $account->id,
                'email' => $account->email,
                'role' => $account->role,
            ],
            'profile' => $profile,
        ], 200);
    }


    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:accounts,email',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Find account by email
        $account = Account::where('email', $request->email)->first();

        if (!$account) {
            return response()->json([
                'message' => 'Account not found.'
            ], 404);
        }

        // Update password (will be auto-hashed by Account model)
        $account->update([
            'password' => $request->new_password,
        ]);

        // Revoke all existing tokens for security
        $account->tokens()->delete();

        return response()->json([
            'message' => 'Password reset successfully. Please login with your new password.'
        ], 200);
    }

    /**
     * Validate doctor credentials
     */
    private function validateDoctorCredentials(array $data): bool
    {
        $currentYear = date('Y');
        $graduationYear = $data['graduation_year'];
        $yearsOfExperience = $data['years_of_experience'];

        // Check graduation year against reasonable ranges
        $minGraduationYear = 1970; // Reasonable minimum
        $maxGraduationYear = $currentYear; // Cannot graduate in the future

        if ($graduationYear < $minGraduationYear || $graduationYear > $maxGraduationYear) {
            return false;
        }

        // Check if years of experience makes sense with graduation year
        $yearsSinceGraduation = $currentYear - $graduationYear;
        
        // Years of experience should not exceed years since graduation
        if ($yearsOfExperience > $yearsSinceGraduation) {
            return false;
        }

        // For fresh graduates, allow 0 years of experience
        if ($yearsSinceGraduation <= 1 && $yearsOfExperience > 1) {
            return false;
        }

        // Check license expiry date is in the future
        $licenseExpiryDate = \Carbon\Carbon::parse($data['license_expiry_date']);
        if ($licenseExpiryDate->isPast()) {
            return false;
        }

        // Additional validation: Check if medical school exists and is active
        $medicalSchool = \App\Models\MedicalSchool::find($data['medical_school_id']);
        if (!$medicalSchool || !$medicalSchool->is_active) {
            return false;
        }

        return true;
    }
}
