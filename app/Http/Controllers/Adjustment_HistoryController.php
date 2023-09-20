<?php

namespace App\Http\Controllers;

use App\Models\bookadjusment;
use App\Models\booklist;
use App\Models\borrowpage;
use Illuminate\Http\Request;

class Adjustment_HistoryController extends Controller
{
    public function index()
    {
        $adjustment = bookadjusment::where('ishide', false)->paginate(10);
        return view('history.adjustment_history', compact('adjustment'));
    }
}
