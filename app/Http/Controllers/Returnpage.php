<?php

namespace App\Http\Controllers;

use App\Models\booklist;
use App\Models\borrowpage;
use App\Models\StudentAccount;
use App\Models\studentlist;
use DateTime;
use Illuminate\Http\Request;

class Returnpage extends Controller
{
    public function index(Request $request)
    {
        $books = booklist::where('ishide', false)->get();
        if ($request->student) {
            $student = StudentAccount::where('student_number', $request->student)->first();
            $borrowbook = $student ? $student->student->borrow_books : [];
        } else {
            $student = null;
            $borrowbook = [];
        }
        return view('returnpage', compact('books', 'student', 'borrowbook'));        
    }

    public function update(Request $request)
    {
        $stud = StudentAccount::where('student_number', $request->studentId)->value('student_id');
        foreach ($request->bookdata as $key => $value) {
            $book = borrowpage::where('id',$value)->where('studentid', $stud);
            $book->update(['bookstatus' => 'returned']);
        }
    }
}
