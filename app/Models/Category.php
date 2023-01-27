<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    // protected $fillable = [
    //     'name',
    // ];

    public function posts_table(){
        //Funzione di relazione
        //La categoria ha molti posts associati
        return $this->hasMany( 'App\Models\Post');  
    }

}
