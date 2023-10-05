<?php

namespace App\Http\Controllers;


use App\Imports\Ebook_Import;
use App\Models\ebooks;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class EbookController extends Controller
{
    function index()
    {
        $ebook = ebooks::paginate(50);
        return view('books.e_book', compact('ebook'));
    }


    public function importEbooks(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);
        $file = $request->file('file');
        Excel::import(new Ebook_Import, $file);
        return redirect('/ebook')->with('success', 'Import completed successfully.');
    }
}
