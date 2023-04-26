<?php

namespace App\Http\Controllers;

use App\Models\bookadjusment;
use App\Models\booklist;
use App\Models\copies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            bookadjusment::create([
                'bookid' =>  $request->bookid,
                'action' => 'added',
                'performby'=> Auth::user()->name,
                'number_adjust' => $request->addcopies,
                'comment' => 'added successfully'
            ]);
            return back();
        }
    }
    
    public function updatecopiesnegative(Request $request)
    {
        $avail = $request->availcopies;
        if ($request->lesscopies<=0 || $request->lesscopies>$avail) {
            return back()->with('Error', 'It must be number or less than the available copies.');
        } else {
            copies::create([
                'bookid' => $request->bookid,
                'action' => 'lessen',
                'copies' =>  $request->lesscopies
            ]);
            bookadjusment::create([
                'bookid' =>  $request->bookid,
                'action' => 'lessen',
                'performby'=> Auth::user()->name,
                'number_adjust' => $request->lesscopies,
                'comment' => $request->comment
            ]);
            return back();
        }
    }

    public function get_copies($id)
    {
         $book  = booklist::find($id);
         $copy =  $book->numberofcopies();           
         return compact('copy');
    }
}
