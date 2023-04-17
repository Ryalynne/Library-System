<?php

namespace App\Http\Controllers;

use App\Models\copies;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totaladded = copies::where('action', 'added')->get();
        $totaldata1 = $totaladded->sum('copies');
        
        $totalless = copies::where('action', 'lessen')->get();
        $totaldata2 = $totalless->sum('copies');
        $totaldata  =  $totaldata1-$totaldata2;
        return view('home', compact('totaldata'));
    }
}
