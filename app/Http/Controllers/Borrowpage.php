<?php

namespace App\Http\Controllers;

use App\Models\booklist;
use App\Models\borrowpage as ModelsBorrowpage;
use App\Models\copies;
use App\Models\studentlist;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Validator;

class borrowpage extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $books = booklist::where('ishide', false)->get();
        $copies = copies::where('ishide', false)->get();
        $student = studentlist::where('studentno', $request->student)->first();
        return view('borrowpage', compact('books', 'student', 'copies'));
    }

    public function storebookborrow(Request $request)
    {
        $student = $request->studentId;
        $studentno = studentlist::where('studentno', $student)->value('id');
        $date = date('Y:m:d', strtotime('+3 weekdays'));
    
        // Create a new transaction record with a unique transaction number
        $transaction = Transaction::create([
            'transaction_number' => uniqid(),
        ]);
    
        foreach ($request->bookList as $key => $value) {
            // Duplicate the same transaction number in each entry
            ModelsBorrowpage::create([
                'bookid' =>  $value,
                'studentid' => $studentno,
                'bookstatus' => 'onlend',
                'duedate' => $date,
                'transaction' => $transaction->transaction_number,
            ]);
        }
    }
    
}
