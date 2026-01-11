<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function getDoctors()
    {
        $doctors = Account::with('doctor')->where('role', 'doctor')
            ->get()
            ->map(function ($account) {
                return [
                    'id' => $account->id,
                    'name' => $account->doctor->name,
                    'specialization' => $account->doctor->specialization,
                ];
            });

        return response()->json([
            'message' => 'Doctors retrieved successfully.',
            'success' => true,
            'doctors' => $doctors
        ]);
    }
}
