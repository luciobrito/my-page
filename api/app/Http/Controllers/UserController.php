<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\UserImage;
use App\Models\ProfileView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
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
    public function Profile($username, Request $request){
        $user_data = 
        User::select('id','name', 'username', 'created_at')
        ->where('username', $username)->first();
        //Se o usuário não for encontrado, retorna 404
        if(!$user_data) return response('', 404);
        
        $user_posts = 
        Post::select('id','title', 'body', 'updated_at')
        ->where('user_id', $user_data->id)->get();
        
        $user_image = 
        UserImage::select('name')->where('user_id', $user_data->id)->first();
        
        //Verifica se o perfil é do usuário logado
      
        $is_current_user = Auth::check() ? Auth::user()->id == $user_data->id : false;
        
        //TODO: Transformar o cadastro de visualização em uma função
        //Última visualização do IP
        $last_view_date = ProfileView::where('user_ip', $request->getClientIp())->orderByDesc('view_date')->first();
        
        //Conta os segundos desde a última visualização do ip
        $time_diff = $last_view_date ? time() - $last_view_date->view_date : 1000;
       
       
        //Se não for o dono do perfil ou a diferença de tempo for maior que 60
        if(!$is_current_user && $time_diff > 60) 
            DB::table('profileview')
            ->insert([
            'user_ip'=> $request->getClientIp(), 
            'viewer_id'=> Auth::check() ? Auth::user()->id : null,
            'user_id' => $user_data->id,
            'view_date' => time()
        ]);
        
        $response_object = [
            'name' => $user_data->name, 
            'username' => $user_data->username, 
            'joined_in' => $user_data->created_at,
            'profile_picture' => $user_image ? $user_image->name : null,
            'is_current_user'=> $is_current_user,
            'posts' => $user_posts,
            'time_diff' => $time_diff
        ];

       return response($response_object, 200);
       
    }
    public function UpdateProfilePicture(Request $request){
        /*TODO: 
            1 - Se o usuário já tiver uma foto, apagar a antiga e upar a nova
            2 - Colocar o campo user_id como unique, na tabela userimage
        */
        $user = Auth::user();
        $profilePicture = UserImage::where('user_id', $user->id)->first();
        $validator = Validator::make(
            $request->all(),
            ['image' => 'required|image:jpeg,png,jpg,gif,svg|max:2048']);
        if ($validator->fails())
            return response($validator->messages()->first(), 500);
        $image = $request->file('image');
        $extension = $image->getClientOriginalExtension();
        $fileName = time() . uniqid() . ".$extension";
        
        //Excluir a foto antiga do usuário, se houver
        if($profilePicture){ 
            Storage::disk('public')->delete("users_images/$profilePicture->name");
            $profilePicture->delete();
        }
        
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
