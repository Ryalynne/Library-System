<?php

namespace App\Http\Controllers;

use App\Models\booklist;
use App\Models\BorrowController as ModelsBorrowpage;
use App\Models\borrowpage;
use App\Models\copies;
use App\Models\StudentAccount;
use App\Models\StudentDetails;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\UserStaff;

class Borrow_Controller extends Controller
{
    public function index(Request $request)
    {
        $books = booklist::where('ishide', false)->get();
        $copies = copies::where('ishide', false)->get();
        $value = [];
        $designated = [];
        if ($request->data) {
            $word = 'employee';
            if (strpos($request->data, $word) !== false) {
                // Employee
                $data = explode(":", $request->data);
                $data = count($data) > 1 ? $data[1] : str_replace($word, '', $request->data);
                $value = UserStaff::where('email', $data)->first();
                $value = $value->staff;
                $designated = $value->job_description;
            } else {
                // Student
                $data = explode(".", $request->data);
                $data = count($data) > 1 ? $data[0] : null;
                $value = StudentAccount::where('student_number', $data)->first();
                $value = StudentDetails::find($value->id);
                $designated = $value->enrollment_assessment ?  $value->enrollment_assessment->year_level() . " " . $value->enrollment_assessment->course->course_code : '';
            }
        }
        return view('books.borrow_page', compact('books', 'copies', 'value', 'designated'));
    }

    public function storebookborrow(Request $request)
    {
        if ($request->data) {
            $word = 'employee';
            if (strpos($request->data, $word) !== false) {
                // Employee
                $data = explode(".", $request->data);
                $data = count($data) > 1 ? $data[0] : null;
                $value = UserStaff::where('email', $data)->first();
                $duedateemployee = date('Y:m:d', strtotime('+5 weekdays'));
                $transaction = Transaction::create(['transaction_number' => uniqid(),]);
                foreach ($request->bookList as $key => $bookID) {
                    $array = [
                        'bookid' =>  $bookID,
                        'studentid' => $value->email,
                        'bookstatus' => 'onlend',
                        'transaction' => $transaction->transaction_number,
                        'duedate' => $duedateemployee,
                    ];
                }
                borrowpage::create($array);
            } else {
                // Student
                $data = explode(".", $request->data);
                $data = count($data) > 1 ? $data[0] : null;
                $value = StudentAccount::where('student_number', $data)->first();
                $duedatestudent = date('Y:m:d', strtotime('+3 weekdays'));
                $transaction = Transaction::create(['transaction_number' => uniqid(),]);
                foreach ($request->bookList as $key => $bookID) {
                    $array = [
                        'bookid' =>  $bookID,
                        'studentid' => $value->student_number,
                        'bookstatus' => 'onlend',
                        'transaction' => $transaction->transaction_number,
                        'duedate' => $duedatestudent,
                    ];
                }
                borrowpage::create($array);
            }
        }
    }
}
