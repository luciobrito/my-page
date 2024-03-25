<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function Create(Request $request){
        $credentials = $request->validate([
            "name"=> "required",
            "username"=> "required",
            "email"=> "required|email",
            "password"=>"required"
        ]);
        User::create($credentials);
        return response()
        ->json("Usuario criado com sucesso!", 201);
    }
    public function Self(){
        return Auth::user();
    }
    /*Debug classes */
    public function getById($id){
        return User::find($id);
    }
    public function getAll(){
        return User::all();
    }
}
