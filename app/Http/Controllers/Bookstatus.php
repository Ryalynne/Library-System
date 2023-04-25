<?php

namespace App\Http\Controllers;

use App\Models\booklist;
use App\Models\borrowpage;
use App\Models\studentlist;
use Illuminate\Http\Request;

class Bookstatus extends Controller
{
    /**
     * Show the form for creating the resource.
     */
    public function index(Request $request)
    {
        $books = booklist::where('ishide', false)->paginate(10);
        $borrow = borrowpage::where('ishide', false)->where('bookstatus', 'onlend')->paginate(10);
        $return = borrowpage::where('ishide', false)->where('bookstatus', 'returned')->paginate(10);
        $student = studentlist::where('ishide', false)->paginate(10);
        return view('bookstatus', compact('books','borrow','student','return'));
    }


    public function create(): never
    {
     
    }

    /**
     * Store the newly created resource in storage.
     */
    public function store(Request $request): never
    {
     
    }

    /**
     * Display the resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the resource from storage.
     */
    public function destroy(): never
    {
     
    }
}
