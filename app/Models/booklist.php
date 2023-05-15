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
        $borrow = $this->hasMany(borrowpage::class, 'bookid')->where('bookstatus', 'onlend')->count();
        $fine = $this->hasMany(borrowpage::class, 'bookid')->where('bookstatus', 'fine')->count();
        $minis = $data + $borrow + $fine;
        // return  $this->hasMany(copies::class, 'bookid')->where('action', 'added')->sum('copies') - $borrow + $data;
        return  $this->hasMany(copies::class, 'bookid')->where('action', 'added')->sum('copies') - $minis;
    }
    public function getstatus($id)
    {
        return $this->hasMany(borrowpage::class, 'bookid')->where('studentid',$id)->where('bookstatus', 'onlend')->value('bookstatus');
    }
}
