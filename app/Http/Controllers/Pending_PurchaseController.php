<?php

namespace App\Http\Controllers;

use App\Models\purchasemodel;
use Illuminate\Http\Request;

class Pending_PurchaseController extends Controller
{
    public function index()
    {
        $Order = purchasemodel::where('ishide', false)->select('department', 'status', 'requestedby', 'dateofdelivery', 'created_at', 'vendorid', 'transaction')->distinct()->whereNot('status', 'complete')->whereNot('status', 'test')->paginate(10);
        return view('requisition.pendingpurchase', compact('Order'));
    }

    public function redirectToOrder($id)
    {
        // Logic to retrieve the order based on the provided $id
        $order = purchasemodel::find($id);

        // Check if the order exists
        if ($order) {
            // Redirect to the order page
            return redirect()->route('receivepurchaseorder', ['transaction' => $order->transaction]);
        } else {
            // Handle the case when the order doesn't exist
            return back()->with('error', 'Order not found.');
        }
    }

    public function cancelOrder(Request $request)
    {
        
        $order = purchasemodel::where('transaction', $request->transaction);

        if ($order) {
            $order->status = 'cancel';
            $order->save();

            return response()->json(['message' => 'Order canceled successfully.']);
        }

        return response()->json(['message' => 'Order not found.'], 404);
    }

    public function findtransaction($id){

        $transaction = purchasemodel::where('transaction', $id)->get();
        return compact('transaction');
    }
}
