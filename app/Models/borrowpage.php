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

    public function get_borrowedstatus($studentid,$bookid)
    {
          studentlist::find($studentid)->where('borrowpages.bookid',$bookid)
          ->join('borrowpages','borrowpages.student_id','studentlists.id')
          ->join('booklists','booklists.id','borrowpages.bookid')->get();      
    }
    
}
