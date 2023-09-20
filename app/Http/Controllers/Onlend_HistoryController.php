<?php

namespace App\Http\Controllers;

use App\Models\booklist;
use App\Models\borrowpage;
use App\Models\studentlist;
use Illuminate\Http\Request;

class Onlend_HistoryController extends Controller
{
    /**
     * Show the form for creating the resource.
     */
    public function index(){
        $borrow = borrowpage::where('ishide', false)->where('bookstatus', 'onlend')->paginate(10);
        return view('history.onlend_history' ,compact('borrow'));
    }
}
