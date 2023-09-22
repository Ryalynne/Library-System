<?php

namespace App\Http\Controllers;
use App\Models\vendortable;
use Illuminate\Http\Request;

class Vendor_ListController extends Controller
{
    public function index()
    {
        $vendor = vendortable::where('ishide', false)->get();
        return view('requisition.Vendorlist', compact('vendor'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'vendorName' => 'required',
            'vendorContact' => 'required',
        ]);
        $vendor = new vendortable();
        $vendor->vendorName = $request->input('vendorName');
        $vendor->vendorContact = $request->input('vendorContact');
        $vendor->save();
        return back();
    }
    public function updateremove($id)
    {
        $vendor = vendortable::find($id);
        $vendor->ishide = true;
        $vendor->save();
        return response()->json([
            'message' => 'Vendor remove successfully'
        ]);
    }
    public function get_vendor($id)
    {
        $vendor = VendorTable::with('vendor')->find($id)->where('ishide', false)->first();
        return $vendor;
    }
    
}
