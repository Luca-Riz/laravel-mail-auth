<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 20; $i++){
            //creare l'istanza
            $newPost = new Post();

            //generare i dati
            $newPost->title = 'Post numero ' . ($i + 1);
            $newPost->slug = Str::slug($newPost->title, '-'); //slug
            $newPost->content = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae in quos nam, adipisci eum dolorem non soluta maiores repellat. Ipsum culpa nobis minima consequuntur nemo labore voluptatum eligendi asperiores minus!';

            //salvare i dati
            $newPost->save();
        }
    }
}
