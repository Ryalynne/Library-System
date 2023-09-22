<?php

namespace App\Http\Controllers;

use App\Models\purchasemodel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Back_OrderController extends Controller
{
    public function index(Request $request)
    {

        if ($request->transaction) {
            $transaction = purchasemodel::where('transaction', $request->transaction)->where('status', 'backorder')->get();
            $order = [];

            foreach ($transaction as $transaction) {
                $order[] = $transaction->puchasebook;
            }
        } else {
            $transaction = [];
            $order = [];
        }

        return view('requisition.backorderpurchaseorder', compact('transaction', 'order'));
    }

    public function get_transaction($transaction)
    {
        $transaction = purchasemodel::where('transaction', $transaction)->where('status', 'backorder')->first();
        if ($transaction) {
            return compact('transaction');
        }
    }

    public function updateReceivedQuantity($id)
    {
        $book = purchasemodel::find($id);
        if (!$book) {
            return response()->json(['message' => 'Book not found.'], 404);
        }
        $receivedQuantity = request()->input('receivedQuantity');
        $total =  $receivedQuantity + $book->received;
        if ($total == $book->quantity) {
            $book->status = 'complete';
            $book->received = $total;
            $book->receivedby = Auth::user()->name;
        } else {
            $book->status = 'backorder';
            $book->received = $total;
            $book->receivedby = Auth::user()->name;
        }
        $book->save();

        return response()->json(['message' => 'Received quantity updated successfully.']);
    }
    

}
