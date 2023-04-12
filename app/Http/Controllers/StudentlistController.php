<?php

namespace App\Http\Controllers;

use App\Models\studentlist;
use App\Http\Requests\StorestudentlistRequest;
use App\Http\Requests\UpdatestudentlistRequest;

class StudentlistController extends Controller
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
    public function store(StorestudentlistRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(studentlist $studentlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(studentlist $studentlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatestudentlistRequest $request, studentlist $studentlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(studentlist $studentlist)
    {
        //
    }

    public function get_student($data)
    {
        $student = studentlist::find($data);
        return compact('student');
    }


}
