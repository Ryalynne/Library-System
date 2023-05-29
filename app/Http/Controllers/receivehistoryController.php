<?php

namespace App\Http\Controllers;

use App\Models\purchasemodel;
use Illuminate\Http\Request;

class receivehistoryController extends Controller
{
    public function index(){
        $receive = purchasemodel::where('status', 'complete')->paginate(10);
        return view('receivehistory', compact('receive'));
    }
}
