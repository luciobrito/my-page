<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\UserImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{/*
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
    }*/
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
        $user_image = UserImage::select('name')->where('user_id', $user_data->id)->first();
        $response_object = [
            'name' => $user_data->name, 
            'username' => $user_data->username, 
            'joined_in' => $user_data->created_at,
            'profile_picture' => $user_image ? $user_image->name : null,
            'posts' => $user_posts
        ];

       return response($response_object, 200);
       
    }
    public function UpdateProfilePicture(Request $request){
        /*TODO: 
            1 - Se o usuário já tiver uma foto, apagar a antiga e upar a nova
            2 - Colocar o campo user_id como unique, na tabela userimage
        */
        $user = Auth::user();
        $validator = Validator::make(
            $request->all(),
            ['image' => 'required|image:jpeg,png,jpg,gif,svg|max:2048']);
        if ($validator->fails())
            return response($validator->messages()->first(), 500);
        $image = $request->file('image');
        $extension = $image->getClientOriginalExtension();
        $fileName = time() . uniqid() . ".$extension";
        $image_uploaded_path = $image->storeAs('public/users_images', $fileName);
        UserImage::create(['name'=> $fileName, 'user_id' => $user->id]);
        return response('Foto de perfil atualizada com sucesso!', 201);

    }
    /*Debug classes */
    public function getById($id){
        return User::find($id);
    }
    public function getAll(){
        return User::all();
    }
}
