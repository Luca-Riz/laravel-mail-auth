<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //? tutti i post su unica pagina
        // $posts = Post::all();

        // return response()->json([
        //     'success' => true,
        //     'results' => $posts
        // ]);

        //? paginazione
        $posts = Post::paginate(4);

        $posts->each(function($post) {
            if($post->cover){  //se c'é l'url aggiungilo
                $post->cover = url('storage/' .$post->cover);
            }
        });

        return response()->json([
            'success' => true,
            'results' => $posts
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->with(['category','tags'])->first();
        if($post){
            if($post->cover){ //se c'é il post
                $post->cover = url('storage/' .$post->cover); //creo l'url percorso assoluto
            }
            return response()->json([
                'success' => true,
                'results' => $post
            ]);
        }
        return response()->json([
            'success' => false,
            'results' => 'non ce ne sono'
        ]);
    }

}
