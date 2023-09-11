<?php

namespace App\Http\Controllers;

use App\Models\booklist;
use App\Models\BorrowController as ModelsBorrowpage;
use App\Models\borrowpage;
use App\Models\copies;
use App\Models\Staff;
use App\Models\StudentAccount;
use App\Models\StudentDetails;
use App\Models\studentlist;
use App\Models\teacherlist;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\UserStaff;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $books = booklist::where('ishide', false)->get();
        $copies = copies::where('ishide', false)->get();
        //$student = studentlist::where('studentno', $request->student)->first();
        // $student = $request->student ? StudentAccount::where('student_number', $request->student)->first() : [];
        // $teacher = $request->teacher ? Staff::where('staff_no', $request->teacher)->first() : [];
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
                $designated = $value->enrollment_assessment ?  $value->enrollment_assessment->year_level() ." ".$value->enrollment_assessment->course->course_code : '';
            }
        }
        //return $value;
        //return view('borrowpage', compact('books',  'copies'));
        return view('books.borrow_page', compact('books', 'copies', 'value', 'designated'));
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

            borrowpage::create($data);
        }
    }
}
