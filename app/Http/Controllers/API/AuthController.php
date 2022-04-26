<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password')))
        {
            return response()
                ->json(['message' => 'Não autorizado'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json([
                'message' => 'Olá '.$user->email.', Bem vindo',
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
    }

    // method for user logout and delete token
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return [
            'message' => 'Usuário desconectado'
        ];
    }
}
