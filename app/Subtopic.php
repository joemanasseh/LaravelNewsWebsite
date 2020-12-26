<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subtopic extends Model
{
    //
    public function topics()
    {
        return $this->belongsToMany(Topic::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
