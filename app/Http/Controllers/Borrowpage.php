<?php

namespace App\Http\Controllers;

use App\Models\booklist;
use App\Models\borrowpage as ModelsBorrowpage;
use App\Models\copies;
use App\Models\studentlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class borrowpage extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $books = booklist::where('ishide', false)->paginate(10);
        $student = studentlist::find($request->student);
        $copies = copies::where('ishide', false)->get();
        return view('borrowpage', compact('books', 'student'));
    }
    public function create()
    {
        //
    }

    public function store(Request $request)
    {

    }
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
