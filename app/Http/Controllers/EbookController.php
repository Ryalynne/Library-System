<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EbookController extends Controller
{
    function index(){
        
        return view('books.e_book');
    }
}
