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
        $books = booklist::where('ishide', false)->paginate(10);
        $student = studentlist::find($request->student);
        $borrowbook = borrowpage::where('ishide', false)->where('bookstatus', 'onlend')->where('studentid', $request->student)->paginate(10);
        return view('returnpage', compact('books', 'student','borrowbook'));
    }

    public function create(): never
    {
    }


    public function store(Request $request): never
    {
    }


    public function show()
    {
        //
    }


    public function edit()
    {
        //
    }

    /**
     * Update the resource in storage.
     */
    public function update(Request $request)
    {
        $student = $request->studentId;
        foreach ($request->bookdata as $key => $value) {
            $bookid = borrowpage::where('bookid', $value)->where('studentid', $student);
            $bookid->update([
                'bookstatus' => 'returned',
            ]);
        }
    }

    /**
     * Remove the resource from storage.
     */
    public function destroy(): never
    {
    }
}
