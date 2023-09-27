<?php

namespace App\Http\Controllers;

use App\Models\booklist;
use App\Models\borrowpage;
use App\Models\copies;
use App\Models\purchasemodel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $totaldata  =  $totaldata1 - $totaldata2;
        $totaloflend = borrowpage::where('bookstatus', 'onlend')->count();
        $totalofbooklist = booklist::where('ishide', false)->count();
        $totalofreturn = borrowpage::where('bookstatus', 'returned')->count();
        $totalofdamage = borrowpage::where('bookstatus', 'fine')->count();
        $purchase = purchasemodel::where('status', 'pending')->whereNot('status', 'complete')->whereNot('status', 'backorder')->count();
        $backorder = purchasemodel::where('status', 'backorder')->whereNot('status', 'complete')->whereNot('status', 'pending')->count();

        $currentDate = now();
        $monday = $currentDate->startOfWeek();
        $friday = $currentDate->copy()->startOfWeek()->addDays(4);
        
        $onlendCounts = [];
        
        for ($day = $monday->copy(); $day <= $friday; $day->addDay()) {
            $count = borrowpage::where('bookstatus', 'onlend')
                ->whereDate('created_at', $day->toDateString())
                ->count();
            
            $onlendCounts[] = $count;
        }

        $returnedCounts = [];

        for ($day = $monday->copy(); $day <= $friday; $day->addDay()) {
            $count = borrowpage::where('bookstatus', 'returned')
                ->whereDate('updated_at', $day->toDateString())
                ->count();
            
            $returnedCounts[] = $count;
        }

        return view('home', compact('totaldata', 'totaloflend', 'totalofbooklist', 'totalofreturn', 'totalofdamage', 'purchase', 'backorder', 'onlendCounts', 'returnedCounts'));
    }
}
