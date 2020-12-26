<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pin extends Model
{
    //
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
