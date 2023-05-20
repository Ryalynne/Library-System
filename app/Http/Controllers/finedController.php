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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $student = $request->studentId;
        foreach ($request->bookdata as $key => $value) {
            $bookid = borrowpage::where('id', $value)->where('studentid', $student);
            $bookid->update([
                'bookstatus' => 'fine',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
