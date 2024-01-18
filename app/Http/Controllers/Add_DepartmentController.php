<?php

namespace App\Http\Controllers;

use App\Imports\DepartmentImport;
use App\Models\departmentList;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class Add_DepartmentController extends Controller
{
    function index()
    {
        $department = departmentList::select('departmentName')->paginate(50);
        return view('books.add_department', compact('department'));
    }

    public function store(Request $request)
    {
        departmentList::create([
            'departmentName' => $request->department
        ]);

        return back();
    }

    public function department_import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);
        $file = $request->file('file');
        Excel::import(new DepartmentImport, $file);
        return redirect('/department')->with('success', 'Import completed successfully.');
    }
}
