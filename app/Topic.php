<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //
    public function subtopics()
    {
        return $this->belongsToMany(Subtopic::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
