<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function Create(Request $request){
        $postData = $request->validate([
            'title' => 'required',
            'body'=> 'required',
            'user_id']);
        
        $postData['user_id'] = Auth::user()->id;
        if($create = Post::create($postData)) return response()->json('Post criado com sucesso', 201);
        else return response()->json('Não foi possível criar o Post', 500);
    }
    public function AuthUserPosts(){
        return Post::where('user_id', Auth::user()->id)->simplePaginate(10);
    }
    public function Delete($id){
        $post = Post::find($id);
        if($post->user_id != Auth::user()->id) return response()->json('Não autorizado',401);
        else {$post->delete(); return response()->json('Deletado com sucesso', 200);}
        
    }
    /*Debug functions */
    public function AllPosts(){
        return Post::all();
    }
}
