<?php

namespace App\Http\Controllers;

use App\Models\purchasemodel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class receivepurchaseorderController extends Controller
{
    public function index(Request $request)
    {

        if ($request->transaction) {
            $transaction = Purchasemodel::where('transaction', $request->transaction)->get();
            $order = [];

            foreach ($transaction as $transaction) {
                $order[] = $transaction->puchasebook;
            }
        } else {
            $transaction = [];
            $order = [];
        }

        return view('receivepurchaseorder', compact('order', 'transaction'));
    }

    public function get_transaction($transaction)
    {
        $transaction = purchasemodel::where('transaction', $transaction)->where('status', 'pending')->first();
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
        $book->received = $receivedQuantity;
        $book->receivedby = Auth::user()->name;
        if ($receivedQuantity == $book->quantity) {
            $book->status = 'complete';
        } else {
            $book->status = 'backorder';
        }
        $book->save();

        return response()->json(['message' => 'Received quantity updated successfully.']);
    }
}
