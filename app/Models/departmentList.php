<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class departmentList extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'author', 'copyright', 'accession', 'department','subject','callnumber'
    ];

   
}
