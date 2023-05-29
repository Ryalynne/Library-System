<?php

namespace App\Http\Controllers;

use App\Models\booklist;
use App\Models\borrowpage;
use App\Models\studentlist;
use DateTime;
use Illuminate\Http\Request;

class Returnpage extends Controller
{
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
        return view('returnpage', compact('books', 'student', 'borrowbook'));
    }

    public function update(Request $request)
    {
        $student = $request->studentId;
        $studentid = studentlist::where('studentno', $student)->value('id');
        foreach ($request->bookdata as $key => $value) {
            $bookid = borrowpage::where('id', $value)->where('studentid', $studentid);
            $bookid->update([
                'bookstatus' => 'returned'
            ]);
        }
    }
}
