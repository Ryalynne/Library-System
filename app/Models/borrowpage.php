<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class borrowpage extends Model
{
    use HasFactory;

    protected $fillable =[
        'bookid','studentid','bookstatus','duedate'
    ];

    public function book()
    {
        return $this->belongsTo(booklist::class, 'bookid');
    }

    public function student()
    {
        return $this->belongsTo(studentlist::class, 'studentid');
    }
}
