<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function subtopic()
    {
        return $this->belongsTo(Subtopic::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function readlists()
    {
        return $this->hasMany(Readlist::class);
    }

    public function userslist()
    {
        return $this->belongsTo(User::class);
    }

    public function pins()
    {
        return $this->hasMany(Pin::class);
    }

    // public function readlists()
    // {
    //     return $this->belongsToMany(Readlist::class, 'article_readlist');
    // }

}
