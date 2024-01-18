<?php

namespace App\Http\Controllers;

use App\Imports\SubjectImport;
use App\Models\subjectList;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class Add_SubjectController extends Controller
{
    function index()
    {
        $subject = subjectList::select('subjectName')->paginate(50);
        return view('books.add_subject', compact('subject'));
    }

    public function store(Request $request)
    {
        subjectList::create([
            'subjectName' => $request->subject
        ]);

        return back();
    }

    public function subject_import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);
        $file = $request->file('file');
        Excel::import(new SubjectImport, $file);
        return redirect('/subject')->with('success', 'Import completed successfully.');
    }
}
