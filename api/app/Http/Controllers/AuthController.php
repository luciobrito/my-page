<?php

namespace App\Http\Controllers;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRegisterRequest;

class AuthController extends Controller
{
    public function Register(UserRegisterRequest $request){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username'  => $request->username,
            'password' => $request->password
        ]);
       
        if($user) {
        $token = auth()
        ->attempt([
        'email' => $request->email,
        'password' => $request->password]);
        return response()->json([
            'access_token' => $this->respondWithToken($token, $request->username)
        ],201);}
        else return response()->json(['message' => 'Usuário não pôde ser criado'], 400);
    }
    public function Login(Request $request)
    {

        $credentials = $request->only(['email', 'password']);
        $user = User::where('email', $credentials['email'])->first();
        $error_message = $user ? "Senha incorreta": "Usuario inexistente!";
        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error_message'=> $error_message], 401);}

        return $this->respondWithToken($token, $user->username);
    }
    public function Logout(){
        Auth::logout();
    }
    protected function respondWithToken($token, $username)
    {
        return response()->json([
            'access_token' => $token,
            'username' => $username
        ]);
    }

}
