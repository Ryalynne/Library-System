<?php

namespace App\Http\Controllers;

use App\Models\borrowpage as ModelsBorrowpage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class borrowpage extends Controller
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
        $validator = Validator::make($request->all(),[
            'bookid'=>'required',
            'studentid'=> 'required',
            'borrowedcopies'=> 'required',
            'dateborrowed'=> 'required',
            'duedate'=> 'required',
        ]);
       ModelsBorrowpage::create([
           'studentid'=>$request->studid,
           'borrowedcopies'=> $request->borrow,
           'dateborrowed'=> $request->dateborrowed,
           'duedate'=> $request->duedate  
        ]);     
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
