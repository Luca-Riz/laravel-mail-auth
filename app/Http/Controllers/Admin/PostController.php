<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $categories = Category::all();
        return view('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->tags);

        //validazione dei dati
        $request->validate([
            'title' => 'required|max:60',
            'content' => 'required',
            'image' => 'nullable|image'
        ]);

        // prendere dati
        $data = $request->all();
        // dd($data);

        // creare nuova istanza coi dati ottenuti dalla request
        $new_post = new Post();

        $slug = Str::slug($data['title'], '-');

        // se c'é un duplicato
        $slug_base = $slug;

        $slug_presente = Post::where('slug', $slug)->first();

        $contatore = 1;
        while ($slug_presente) {
            $slug = $slug_base . '-' . $contatore;

            $slug_presente = Post::where('slug', $slug)->first();

            $contatore++;
        }
        // end se c'é un duplicato

        $new_post->slug = $slug;

        if(array_key_exists('image', $data)){
            //? salviamo la nostra immagine e recuperiamo il path
            $cover_path = Storage::put('covers', $data['image']);

            //? salviamo nella colonna della tabella posts l'immagine con il suo percorso
            $data['cover'] = $cover_path;
        }

        $new_post->fill($data);

        // salvare
        $new_post->save();

        $new_post->tags()->attach($request->tags);

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //collegamento con slug (utilizzato nel front office)
    public function show($slug)
    {
        $post = Post::where('slug',$slug)->first();
        return view('admin.posts.show', compact('post'));
    }

    //collegamento con id
    // public function show(Post $post)
    // {
    //     return view('admin.posts.show', compact('post'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //validazione dei dati
        $request->validate([
            'title' => 'required|max:60',
            'content' => 'required',
            'image' => 'nullable|image'
        ]);

        $data = $request->all();

        //? se lo slug é diverso dal precedente ricalcolalo
        if($data['title'] != $post->title){

            $slug = Str::slug($data['title'], '-'); //titolo-di-esempio
            $slug_base = $slug; //titolo-di-esempio

            // se lo slug é uguale ad uno giá presente
            $slug_presente = Post::where('slug', $slug)->first();

            $contatore = 1;
            while($slug_presente){

                //aggiungiamo al post di prima il -contatore
                $slug = $slug_base . '-' . $contatore; //titolo-di-esempio-1

                //controlliamo se il post esiste ancora
                $slug_presente = Post::where('slug', $slug)->first();

                //incrementiamo il contatore
                $contatore++;
            }

            //in ogni caso assegniamo allo slug il valore ottenuto
            $data['slug'] = $slug;
        }

        if(array_key_exists('image', $data)){
            //? salviamo la nostra immagine e recuperiamo il path
            $cover_path = Storage::put('covers', $data['image']);
            
            Storage::delete($post->cover);
            //? salviamo nella colonna della tabella posts l'immagine con il suo percorso
            $data['cover'] = $cover_path;
        }

        $post->update($data);
        $post->tags()->sync($request->tags);

        return redirect()->route('admin.posts.index')->with('updated', 'Hai modificato con successo l\'elemento ' . $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Storage::delete($post->cover);
        $post->delete();
        $post->tags()->detach();
        
        return redirect()->route('admin.posts.index');
    }
}
