<?php

namespace App\Http\Controllers;

use App\Models\booklist;
use App\Models\borrowpage;
use App\Models\copies;
use App\Models\purchasemodel;
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
        $totalofdamage = borrowpage::where('bookstatus','fine')->count();
        $purchase = purchasemodel::where('status', 'pending')->whereNot('status', 'complete')->whereNot('status', 'backorder')->count();
        $backorder = purchasemodel::where('status', 'backorder')->whereNot('status', 'complete')->whereNot('status', 'pending')->count();
        return view('home', compact('totaldata','totaloflend','totalofbooklist','totalofreturn','totalofdamage','purchase','backorder'));
    }
}
