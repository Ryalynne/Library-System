<?php

namespace App\Http\Controllers;

use App\Models\purchasemodel;
use Illuminate\Http\Request;

class Receive_PuchaseOrder_historyController extends Controller
{
    public function index(){
        $receive = purchasemodel::where('status', 'complete')->paginate(10);
        return view('requisition.receivehistory', compact('receive'));
    }
}
