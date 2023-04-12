<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booklist extends Model
{
    use HasFactory;
    protected $fillable = [
        'booktitle','author','datepublish','publisher','isbn','genre'
    ];
    public function numberofcopies()
    {
      
        return $this->hasMany(copies::class, 'bookid')->where('action', 'added')->sum('copies')- copies::where('action', 'lessen')->sum('copies');;

        // return $this->hasMany(copies::class, 'bookid')->where('action', 'added')->sum('copies');
    }  
}
