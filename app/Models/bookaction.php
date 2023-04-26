<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bookaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'bookid', 'action', 'performby'
    ];

    public function book()
    {
        return $this->belongsTo(booklist::class, 'bookid');
    }

}
