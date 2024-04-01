<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class AuthController extends Controller
{
    public function Login(Request $request)
    {

        $credentials = $request->only(['email', 'password']);
        $user = User::where('email', $credentials['email'])->first();
        $error_message = $user ? "Senha incorreta": "Usuario inexistente!";
        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error_message'=> $error_message], 401);}

        return $this->respondWithToken($token);
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token]);
    }
}
