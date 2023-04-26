<?php

namespace App\Http\Controllers;

use App\Models\bookaction;
use App\Models\booklist;
use App\Models\borrowpage;
use App\Models\copies;
use App\Models\studentlist;
use Illuminate\Http\Request;

class Bookhistory extends Controller
{
    /**
     * Show the form for creating the resource.
     */

    public function index(Request $request)
    {
        $action = bookaction::where('ishide', false)->paginate(10);
        return view('bookhistory', compact('action'));
    }


    public function create(): never
    {
        abort(404);
    }

    /**
     * Store the newly created resource in storage.
     */
    public function store(Request $request): never
    {
        abort(404);
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
        abort(404);
    }
}
