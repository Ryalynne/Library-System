<?php

namespace App\Http\Controllers;

use App\Models\booklist;
use Illuminate\Http\Request;

class Archived_HistoryController extends Controller
{
    /**
     * Show the form for creating the resource.
     */
    public function index(){
        $adjustment = booklist::where('ishide', true)->paginate(10);
        return view('history.archived_history', compact('adjustment'));
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
