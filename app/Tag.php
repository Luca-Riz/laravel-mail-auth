<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
        // crea relazione tabella tags
    public function posts(){
        return $this->belongsToMany('App/Post');
    }
}
