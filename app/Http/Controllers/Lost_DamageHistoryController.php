<?php

namespace App\Http\Controllers;

use App\Models\booklist;
use App\Models\borrowpage;
use App\Models\studentlist;
use Illuminate\Http\Request;

class Lost_DamageHistoryController extends Controller
{
    /**
     * Show the form for creating the resource.
     */

     public function index()
    {
        $books = booklist::where('ishide', false)->paginate(10);
        $return = borrowpage::where('ishide', false)->where('bookstatus', 'fine')->paginate(10);
        return view('history.lost_damage_history', compact('books','return'));
    }

}
