<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'category_id',
        'cover'
    ];

    // crea relazione tabella categorie
    public function category(){
        return $this->belongsTo('App\Category');
    }
    
    // crea relazione tabella post
    public function tags(){
        return $this->belongsToMany('App\Tag');
    }
}



