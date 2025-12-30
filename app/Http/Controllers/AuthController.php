<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(AuthRequest $request)
    {
        if (!Auth::attempt($request->validated())) {
            throw ValidationException::withMessages([
                'email' => 'Sorry, those credentials do not match.',
            ]);
        }

        $user = Auth::user();

        $token = $user->createToken('access-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
            'message' => "your're in!"
        ]);
    }
}
