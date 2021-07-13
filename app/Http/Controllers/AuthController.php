<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        Log::info($credentials);

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages(['User not found!']);
        }
        /**
         * @var User
         */
        $user = Auth::user();
        return response()->json(['token' => $user->createToken('auth')->plainTextToken]);
    }
}
