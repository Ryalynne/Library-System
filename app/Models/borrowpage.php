<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class borrowpage extends Model
{
    use HasFactory;

    protected $fillable =[
        'bookid','studentid','borrowedcopies','dateborrowed','duedate'
    ];

    public function get_borrowedcopies($data)
    {
        $borrow = borrowpage::find($data);       
        return compact('borrow');     
    }
}
