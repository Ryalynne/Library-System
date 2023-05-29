<?php

namespace App\Http\Controllers;

use App\Models\booklist;
use App\Models\borrowpage as ModelsBorrowpage;
use App\Models\copies;
use App\Models\StudentAccount;
use App\Models\studentlist;
use Illuminate\Http\Request;
use App\Models\Transaction;


class borrowpage extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $books = booklist::where('ishide', false)->get();
        $copies = copies::where('ishide', false)->get();
        //$student = studentlist::where('studentno', $request->student)->first();
        $student = $request->student ? StudentAccount::where('student_number', $request->student)->first() : [];
        return view('borrowpage', compact('books', 'student', 'copies'));
    }

    public function storebookborrow(Request $request)
    {
        $student = $request->studentId;
        $account = StudentAccount::where('student_number', $student)->first();
        $studentno = $account->student->id;
        $class = $account->student->enrollment_assessment->year_level();
        $datestudent = date('Y:m:d', strtotime('+3 weekdays'));
        $datestaff = date('Y:m:d', strtotime('+5 weekdays'));

        $transaction = Transaction::create([
            'transaction_number' => uniqid(),
        ]);

        foreach ($request->bookList as $key => $value) {
            $data = [
                'bookid' =>  $value,
                'studentid' => $studentno,
                'bookstatus' => 'onlend',
                'transaction' => $transaction->transaction_number,
            ];
            $class = strtolower($class);
            if (strpos($class, 'staff') !== false || strpos($class, 'department') !== false || strpos($class, 'qmr') !== false || strpos($class, 'school director') !== false) {
                $data['duedate'] = $datestaff;
            } else {
                $data['duedate'] = $datestudent;
            }

            ModelsBorrowpage::create($data);
        }
    }
}
