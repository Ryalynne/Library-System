<?php

namespace App\Models;

use App\Http\Controllers\Returnpage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booklist extends Model
{
    use HasFactory;
    protected $fillable = [
        'booktitle', 'author', 'datepublish', 'publisher', 'isbn', 'genre'
    ];
    public function numberofcopies()
    {
        $data = $this->hasMany(copies::class, 'bookid')->where('action', 'lessen')->sum('copies');
        return $this->hasMany(copies::class, 'bookid')->where('action', 'added')->sum('copies') - $data;
    }
    public function getstatus($id)
    {
        return $this->hasMany(borrowpage::class, 'bookid')->where('studentid',$id)->where('bookstatus', 'onlend')->value('bookstatus');
    }
}
