<?php

namespace App\Http\Controllers;

use App\Models\bookborrowed;
use App\Models\copies;
use Illuminate\Http\Request;

class BookborrowedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //  $request->validate([
        //  'bookid'=>'required|numeric',
        //  'studid'=>'required|numeric',
        //  'dateborrowed'=>'required',
        //  'duedate'=>'required',
        // ]);          
        //  bookborrowed::create([
        //  'bookid'=>$request->bookid,
        //  'studid'=>$request->studid,
        //  'dateborrowed'=>$request->dateborrowed,
        //  'duedate'=>$request->duedate,
        // ]);     
        // return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(bookborrowed $bookborrowed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(bookborrowed $bookborrowed)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, bookborrowed $bookborrowed)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(bookborrowed $bookborrowed)
    {
        //
    }

    public function updatecopiesborrow(Request $request){

    }

    public function get_borrowedcopies($data)
    {
        $borrow = bookborrowed::find($data);       
        return compact('borrow');     
    }
}
