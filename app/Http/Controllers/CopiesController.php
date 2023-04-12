<?php

namespace App\Http\Controllers;

use App\Models\copies;
use Illuminate\Http\Request;

class CopiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function updatecopies(Request $request)
    {
        if ($request->addcopies <= 0) {
            return back()->with('Error', 'It must be number or Positive number only.');
        } else {
            copies::create([
                'bookid' => $request->bookid,
                'action' => 'added',
                'copies' =>  $request->addcopies
            ]);
            return back();
        }
    }
    public function updatecopiesnegative(Request $request)
    {
        if ($request->lesscopies) {
            return back()->with('Error', 'It must be number.');
        } else {
            copies::create([
                'bookid' => $request->bookid,
                'action' => 'lessen',
                'copies' =>  $request->addcopies
            ]);
            return back();
        }
    }

    public function get_copies($data)
    {
        $copy = copies::find($data);
        return compact('copy');
    }
}
