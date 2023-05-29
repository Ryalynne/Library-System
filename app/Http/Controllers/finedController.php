<?php

namespace App\Http\Controllers;

use App\Models\booklist;
use App\Models\borrowpage;
use App\Models\finesbooks;
use App\Models\studentlist;
use Illuminate\Http\Request;

class finedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $books = booklist::where('ishide', false)->get();
        if ($request->student) {
            $studentid = studentlist::where('studentno', $request->student)->value('id');
            $student = studentlist::find($studentid);
            $borrowbook = $student->bookborrow;
        } else {
            $student = [];
            $borrowbook = [];
        }
       return view('fined', compact('books', 'student', 'borrowbook'));
    }

    public function store(Request $request)
    {
        $student = $request->studentId;
        $studentid = studentlist::where('studentno', $student)->value('id');
        foreach ($request->bookdata as $key => $value) {
            $bookid = borrowpage::where('id', $value)->where('studentid', $studentid);
            $bookid->update([
                'bookstatus' => 'fine',
            ]);
        }
    }
}
