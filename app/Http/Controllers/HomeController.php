<?php

namespace App\Http\Controllers;

use App\Models\booklist;
use App\Models\borrowpage;
use App\Models\copies;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $totaladded = copies::where('action', 'added')->get();
        $totaldata1 = $totaladded->sum('copies');    
        $totalless = copies::where('action', 'lessen')->get();
        $totaldata2 = $totalless->sum('copies');
        $totaldata  =  $totaldata1-$totaldata2;
        $totaloflend = borrowpage::where('bookstatus','onlend')->count();
        $totalofbooklist = booklist::where('ishide', false)->count();
        $totalofreturn = borrowpage::where('bookstatus','returned')->count();
        return view('home', compact('totaldata','totaloflend','totalofbooklist','totalofreturn'));
    }
}
