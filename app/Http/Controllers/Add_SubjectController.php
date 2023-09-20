<?php

namespace App\Http\Controllers;

use App\Models\subjectList;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class Add_SubjectController extends Controller
{
    function index()
    {
        $distinctSubjects = subjectList::select('subjectName')->distinct()->get()->pluck('subjectName')->toArray();
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

        return view('books.add_subject', compact('paginator'));
    }

    public function store(Request $request)
    {
        subjectList::create([
            'subjectName' => $request->subject
        ]);

        return back();
    }
}
