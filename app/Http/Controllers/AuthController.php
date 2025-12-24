<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Prompts\Output\ConsoleOutput;

class AuthController extends Controller
{
    public function login()
    {
        $console = new ConsoleOutput();
        $authAttr = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $console->writeln('1');

        if (!Auth::attempt($authAttr)) {
            $console->writeln('3');
            throw ValidationException::withMessages([
                'email' => 'Sorry, those credentials do not match.',
            ]);
        }

        $console->writeln('2');

        $user = Auth::user();

        $token = $user->createToken('access-token')->plainTextToken;


        $console->writeln($token);
        $console->writeln($user->name);

        return response()->json([
            'token' => $token,
            'user' => $user,
            'message' => "your're in!"
        ]);
    }
}
