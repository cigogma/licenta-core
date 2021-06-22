<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        $credentials['password'] = Hash::make($credentials['password']);
        $user = User::query()
            ->where('email', $credentials['email'])
            ->where('password', $credentials['password'])
            ->first();
        if (!$user) {
            throw ValidationException::withMessages(['User not found!']);
        }
        return response()->json(['token' => $user->createToken('auth')->plainTextToken]);
    }
}
