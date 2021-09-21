<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Tag;  //mi serve per parlare con db (foreach $seedTags as $tag)

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seedTags = ['Front End', 'Back End', 'Database', 'User Experience'];

        // $slug = Str::slug('Laravel 5 Framework', '-');

        foreach ($seedTags as $tag) {
            $newTag = new Tag();
            
            $newTag->name = $tag;
            $newTag->slug = Str::slug($tag, '-');

            $newTag->save();
        }
    }
}
