<?php

namespace App\Http\Controllers;

use App\Models\booklist;
use App\Models\borrowpage;
use App\Models\studentlist;
use Illuminate\Http\Request;

class Return_HistoryController extends Controller
{
    public function index(){
        $books = booklist::where('ishide', false)->paginate(10);
        $return = borrowpage::where('ishide', false)->where('bookstatus', 'returned')->paginate(10);
        return view('history.return_history', compact('books','return'));
    }
}
