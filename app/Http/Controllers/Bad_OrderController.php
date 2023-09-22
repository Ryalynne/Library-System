<?php

namespace App\Http\Controllers;

use App\Models\purchasemodel;
use Illuminate\Http\Request;

class Bad_OrderController extends Controller
{
    public function index(Request $request)
    {

        if ($request->transaction) {
            $transaction = purchasemodel::where('transaction', $request->transaction)->whereNotIn('status', ['complete'])->get();
            $order = [];

            foreach ($transaction as $transaction) {
                $order[] = $transaction->puchasebook;
            }
        } else {
            $transaction = [];
            $order = [];
        }
        return view('requisition.badorderpuchaseorder', compact('transaction', 'order'));
    }

    public function get_transaction($transaction)
    {
        $transaction = purchasemodel::where('transaction', $transaction)->whereNotIn('status', ['complete'])->first();
        if ($transaction) {
            return compact('transaction');
        }
    }
}
