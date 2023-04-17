<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class studentlist extends Model
{
    use HasFactory;
    protected $fillable =[
        'name','middle','lastname','class'
    ];

    public function bookborrow(){
        return $this->hasMany(borrowpage::class , 'studentid');
    }
}
