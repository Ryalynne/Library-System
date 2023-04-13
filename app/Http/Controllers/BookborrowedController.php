<?php

namespace App\Http\Controllers;

use App\Models\bookborrowed;
use App\Models\copies;
use Illuminate\Http\Request;

class BookborrowedController extends Controller
{
    public function store(Request $request)
     { 
        // bookborrowed::validate([
        //     'bookid'=>'required',
        //     'studentid'=> 'required',
        //     'borrowedcopies'=> 'required',
        //     'dateborrowed'=> 'required',
        //     'duedate'=> 'required'
        // ]);
          bookborrowed::create([
            'bookid'=>'bookid',
            'studentid'=>'studid'
        //  'bookid'=>$request->bookid,
        //  'studentid'=>$request->studid,
        //  'borrowedcopies'=> $request->borrow,
        //  'dateborrowed'=> $request->dateborrowed,
        //  'duedate'=> $request->duedate     
         ]);     

         return back();
    }
}
