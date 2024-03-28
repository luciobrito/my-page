<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
    public function Profile($username){
        $user_data = 
        User::select('id','name', 'username', 'created_at')
        ->where('username', $username)->first();
        if(!$user_data) return response('', 404);
        $user_posts = 
        Post::select('id','title', 'body', 'updated_at')
        ->where('user_id', $user_data->id)->get();

        $response_object = [
            'name' => $user_data->name, 
            'username' => $user_data->username, 
            'joined_in' => $user_data->created_at,
            'posts' => $user_posts
        ];

       return response($response_object, 200);
       
    }
    /*Debug classes */
    public function getById($id){
        return User::find($id);
    }
    public function getAll(){
        return User::all();
    }
}
