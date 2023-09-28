<?php

namespace App\Http\Controllers;

use App\Models\booklist;
use App\Models\BorrowController as ModelsBorrowpage;
use App\Models\borrowpage;
use App\Models\copies;
use App\Models\Staff;
use App\Models\StudentAccount;
use App\Models\StudentDetails;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\UserStaff;

class Borrow_Controller extends Controller
{
    public function index(Request $request)
    {
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
        return view('books.borrow_page', compact('copies', 'value', 'designated'));
    }

    public function fetchBook(Request $request)
    {
        $books = [];
    
        $book = booklist::where('ishide', false)->where('accession', $request->accessionName)->first();
    
        if ($book) {
            $book1 = copies::where('ishide', false)->where('bookid', $book->id)->value('id');
    
            if ($book1) {
                $books[] = $book->toArray();
                if ($request->borrowerName) {
                    $word = 'employee';
                    if (strpos($request->borrowerName, $word) !== false) {
                        // Employee
                        $borrowerName = explode(":", $request->borrowerName);
                        $borrowerName = count($borrowerName) > 1 ? $borrowerName[1] : str_replace($word, '', $request->borrowerName);
                    } else {
                        // Student
                        $borrowerName = explode(".", $request->borrowerName);
                        $borrowerName = count($borrowerName) > 1 ? $borrowerName[0] : null;
                    }
    
                    if ($borrowerName) {
                        $onlend = borrowpage::where('bookid', $book1)
                            ->where('borrower', $borrowerName)
                            ->where('bookstatus', 'onlend')
                            ->get();
    
                        if ($onlend->isEmpty()) {
                            $books[0]['onlend'] = 'available'; 
                        } else {
                            $books[0]['onlend'] = 'onlend'; 
                        }
                    }
                }
            }
        }
    
        return response()->json($books);
    }
    
    public function fetchData(Request $request)
    {
        $data = [];
        $name = $request->input('name');
        if ($request->input('TypeUser') == 'Employee') {
            $staff = Staff::where('last_name', 'LIKE', '%' . $name . '%')->get();
            foreach ($staff as $staffDetail) {
                $data[] = $staffDetail;
            }
        } elseif ($request->input('TypeUser') == 'Student') {
            $studentDetails = StudentDetails::where('last_name', 'LIKE', '%' . $name . '%')->get();
            foreach ($studentDetails as $detail) {
                $studentAccount = StudentAccount::where('student_id', $detail->id)->latest()->first();
                if ($studentAccount) {
                    $relatedStudentDetail = StudentDetails::find($studentAccount->student_id);
                    if ($relatedStudentDetail) {
                        $data[] = $relatedStudentDetail;
                    }
                }
            }
        }
        return response()->json($data);
    }

    public function storebookborrow(Request $request)
    {
        $borrower = "";
        if ($request->has('user')) {
            $user = $request->input('user');
            if (strpos($user, 'employee') !== false) {
                // Employee
                $email = explode(":", $user);
                $email = count($email) > 1 ? $email[1] : str_replace('employee', '', $user);
                $value = UserStaff::where('email', $email)->first();
                $dueDateEmployee = date('Y-m-d', strtotime('+5 weekdays'));
                $borrower = $email;
            } else {
                // Student
                $studentNumberParts = explode(".", $user);
                $studentNumber = count($studentNumberParts) > 1 ? $studentNumberParts[0] : null;
                $value = StudentAccount::where('student_number', $studentNumber)->first();
                $dueDateStudent = date('Y-m-d', strtotime('+3 weekdays'));
                $borrower = $studentNumber;
            }

            if ($value) {
                $transaction = Transaction::create(['transaction_number' => uniqid()]);
                $borrowArray = [];

                foreach ($request->input('books') as $bookID) {
                    $borrowArray[] = [
                        'bookid' => $bookID,
                        'borrower' => $borrower, 
                        'bookstatus' => 'onlend',
                        'transaction' => $transaction->transaction_number,
                        'created_at' => now(),
                        'duedate' => isset($dueDateEmployee) ? $dueDateEmployee : $dueDateStudent,
                    ];
                }
                borrowpage::insert($borrowArray);
                return response()->json(['message' => 'Books borrowed successfully']);
            } else {
                return response()->json(['error' => 'User not found'], 404);
            }
        } else {
            return response()->json(['error' => 'User not specified'], 400);
        }
    }

    function get_user($id, $user)
    {
        $student = StudentAccount::where('student_id', $id)->value('email');
        $employee = UserStaff::where('id', $id)->value('email');
        if ($user == 'Employee') {
            return 'employee' . $employee;
        } elseif ($user == 'Student') {
            return str_replace('@bma.edu.ph', '', $student);
        }
    }
}
