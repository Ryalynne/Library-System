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
}
