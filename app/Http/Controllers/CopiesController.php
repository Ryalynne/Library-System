<?php

namespace App\Http\Controllers;

use App\Models\bookadjusment;
use App\Models\booklist;
use App\Models\copies;
use Exception;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        try {
            $validator = Validator::make($request->all(), [
                'addcopies' => 'required|numeric|min:1',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->messages()
                ]);
            }
            copies::create([
                'bookid' => $request->bookid,
                'action' => 'added',
                'copies' =>  $request->addcopies
            ]);

            bookadjusment::create([
                'bookid' =>  $request->bookid,
                'action' => 'added',
                'performby' => Auth::user()->name,
                'number_adjust' => $request->addcopies,
                'comment' => 'added successfully'
            ]);

            return response()->json(['status' => 200, 'message' => 'Copies added successfully.']);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    public function updatecopiesnegative(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'lesscopies' => 'required|numeric|between:1,' . $request->availcopies,
                'comment' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->messages()
                ]);
            }

            copies::create([
                'bookid' => $request->bookid,
                'action' => 'lessen',
                'copies' =>  $request->lesscopies
            ]);

            bookadjusment::create([
                'bookid' =>  $request->bookid,
                'action' => 'lessen',
                'performby' => Auth::user()->name,
                'number_adjust' => $request->lesscopies,
                'comment' => $request->comment
            ]);
            
            return response()->json(['status' => 200, 'message' => 'Copies Remove successfully.']);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    public function get_copies($id)
    {
        $book  = booklist::find($id);
        $copy =  $book->numberofcopies();
        return compact('copy');
    }
}
