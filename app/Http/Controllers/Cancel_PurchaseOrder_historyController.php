<?php

namespace App\Http\Controllers;

use App\Models\purchasemodel;
use Illuminate\Http\Request;

class Cancel_PurchaseOrder_historyController extends Controller
{
    public function index(){

        $cancel = purchasemodel::where('status', 'cancel')->paginate(10);
        return view('requisition.cancelhistory', compact('cancel'));
    }
}
