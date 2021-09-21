<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // protected $table = 'categories';

    // crea relazione tabgella post
    public function post(){
        return $this->hasMany('App\Post');
    }
}
