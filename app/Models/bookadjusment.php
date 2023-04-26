<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bookadjusment extends Model
{
    use HasFactory;
    protected $fillable = [
        'bookid', 'action', 'performby', 'number_adjust', 'comment'
    ];
    public function book()
    {
        return $this->belongsTo(booklist::class, 'bookid');
    }
}
