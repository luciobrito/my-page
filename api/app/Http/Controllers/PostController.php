<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function Create(Request $request)
    {
        $postData = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'user_id',
        ]);

        $postData['user_id'] = Auth::user()->id;
        if ($create = Post::create($postData)) {
            return response()->json('Post criado com sucesso', 201);
        } else {
            return response()->json('Não foi possível criar o Post', 500);
        }

    }
    public function AuthUserPosts()
    {
        return Post::where('user_id', Auth::user()->id)->simplePaginate(10);
    }
    public function Delete($id)
    {
        $post = Post::find($id);
        if ($post->user_id != Auth::user()->id) {
            return response()->json('Não autorizado', 401);
        } else {
            $post->delete();
            return response()->json('Deletado com sucesso', 200);
        }

    }
    /*Debug functions */
    public function AllPosts()
    {
        return Post::all();
    }
    public function StoreImage(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            ['image' => 'required|image:jpeg,png,jpg,gif,svg|max:2048']
        );
        if ($validator->fails())
            return response($validator->messages()->first(), 500);
        $image = $request->file('image');
        //Busca a extensão original
        $extension = $image->getClientOriginalExtension();
        //Id único para a imagem + extensão original
        $fileName = time() . uniqid() . ".$extension";
        $image_uploaded_path = $image->storeAs('public/posts', $fileName);
        return response('Imagem enviada com sucesso', 201);
    }
}
