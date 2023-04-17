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
        $data = $this->hasMany(copies::class, 'bookid')->where('action', 'lessen')->sum('copies');
        return $this->hasMany(copies::class, 'bookid')->where('action', 'added')->sum('copies')-$data;
    }
    public function getstatus(){
      return $this->hasMany(borrowpage::class, 'bookid')->where('updated_at','2023-04-13 08:32:09')->value('bookstatus');
    }
}
