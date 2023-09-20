<?php

namespace App\Http\Controllers;

use App\Models\departmentList;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class Add_DepartmentController extends Controller
{
    function index()
    {
        $distinctSubjects = departmentList::select('departmentName')->distinct()->get()->pluck('departmentName')->toArray();
        $page = request()->get('page', 1);
        $perPage = 50;
        $total = count($distinctSubjects);
        $paginator = new LengthAwarePaginator(
            array_slice($distinctSubjects, ($page - 1) * $perPage, $perPage),
            $total,
            $perPage,
            $page
        );

        $paginator->withPath('/subject'); 

        return view('books.add_department', compact('paginator'));
    }

    public function store(Request $request)
    {
        departmentList::create([
            'departmentName' => $request->department
        ]);

        return back();
    }
}
