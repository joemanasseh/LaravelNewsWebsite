<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Readlist extends Model
{
    //

    public function articles()
    {
        return $this->belongsTo(Article::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
