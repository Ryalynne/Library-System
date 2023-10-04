<?php

namespace App\Http\Controllers;


use App\Imports\Ebook_Import;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class EbookController extends Controller
{
    function index(){
        
        return view('books.e_book');
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
