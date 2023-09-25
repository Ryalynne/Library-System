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
        $books = booklist::where('ishide', false)->paginate(50);
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

    public function fetchData(Request $request)
    {
        $name = $request->input('name');
        $data = StudentDetails::where('first_name', '=', $name)->get();
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
                    // Add book data to the array
                    $borrowArray[] = [
                        'bookid' => $bookID,
                        'borrower' => $borrower, // Use the original user value
                        'bookstatus' => 'onlend',
                        'transaction' => $transaction->transaction_number,
                        'created_at' => now(),
                        'duedate' => isset($dueDateEmployee) ? $dueDateEmployee : $dueDateStudent,
                    ];
                }

                borrowpage::insert($borrowArray);

                // Return a response, e.g., a success message
                return response()->json(['message' => 'Books borrowed successfully']);
            } else {
                // Handle the case where the user is not found (e.g., return an error response)
                return response()->json(['error' => 'User not found'], 404);
            }
        } else {
            // Handle the case where no user is provided (e.g., return an error response)
            return response()->json(['error' => 'User not specified'], 400);
        }
    }
}
