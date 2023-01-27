<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function posts_table()
    {
        return $this->belongsToMany('App\Models\Post'); // al posto del percorso si puo usare Post::class
    }
}
