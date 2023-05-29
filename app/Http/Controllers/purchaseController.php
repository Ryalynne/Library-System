<?php

namespace App\Http\Controllers;

use App\Models\purchasemodel;
use App\Models\Transaction;
use App\Models\vendortable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class purchaseController extends Controller
{
    public function index(Request $request)
    {
        $vendor = vendortable::where('ishide', false)->where('id', $request->vendor)->first();
        $id = purchasemodel::all();
        return view('purchaseOrder', compact('vendor', 'id'));
    }

    public function createpurchaseOrder(Request $request)
    {
        $titles = $request->booktitle;
        $quantities = $request->quantity;
        $unitprices = $request->unitprice;
        $vendorID = $request->vendorID;
        $requestedBY = $request->requestedBY;
        $department = $request->department;
        $dateofdelivery = $request->dateofdelivery;

        $transaction = Transaction::create([
            'transaction_number' => uniqid(),
        ]);

        for ($i = 0; $i < count($titles); $i++) {
            // Skip when the title is null or empty
            if (empty($titles[$i])) {
                continue;
            }

            $book = new purchasemodel();
            $book->vendorid = $vendorID;
            $book->requestedby = $requestedBY;
            $book->department = $department;
            $book->dateofdelivery = $dateofdelivery;
            $book->title = $titles[$i];
            $book->quantity = $quantities[$i];
            $book->unitprice = $unitprices[$i];
            $book->status = "pending";
            $book->createdby = Auth::user()->name;
            $book->transaction = $transaction->transaction_number;
            $book->receivedby = "No Current Receiver";

            try {
                $book->save();
                // Book saved successfully
            } catch (\Exception $e) {
                // Error occurred while saving the book
                return response()->json(['message' => 'Error saving book: ' . $e->getMessage()], 500);
            }
        }

        return response()->json(['message' => 'Books saved successfully'], 200);
    }
}
