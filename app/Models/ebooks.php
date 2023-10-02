<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ebooks extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'author', 'copyright', 'links'
    ];
}
