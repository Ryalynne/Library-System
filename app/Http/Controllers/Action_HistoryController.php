<?php

namespace App\Http\Controllers;

use App\Models\bookaction;
use App\Models\booklist;
use App\Models\borrowpage;
use App\Models\copies;
use App\Models\studentlist;
use Illuminate\Http\Request;

class Action_HistoryController extends Controller
{
    /**
     * Show the form for creating the resource.
     */

    public function index(Request $request)
    {
        $action = bookaction::where('ishide', false)->paginate(50);
        return view('history.action_history', compact('action'));
    }
}
