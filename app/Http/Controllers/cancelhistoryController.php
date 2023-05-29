<?php

namespace App\Http\Controllers;

use App\Models\purchasemodel;
use Illuminate\Http\Request;

class cancelhistoryController extends Controller
{
    public function index(){

        $cancel = purchasemodel::where('status', 'cancel')->paginate(10);
        return view('cancelhistory', compact('cancel'));
    }
}
