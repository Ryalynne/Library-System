<?php

namespace App\Http\Controllers;

use App\Models\booklist;
use App\Models\borrowpage;
use App\Models\finesbooks;
use App\Models\StudentAccount;
use App\Models\StudentDetails;
use App\Models\studentlist;
use App\Models\UserStaff;
use Illuminate\Http\Request;

class Lost_damage_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $books = booklist::where('ishide', false)->get();
        $borrowbook = [];
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
                $borrowbook = borrowpage::where('bookstatus', 'onlend')->where('borrower', $data)->get();
            } else if (strpos($request->data, $word) === false) {
                // Student
                $data = explode(".", $request->data);
                $data = count($data) > 1 ? $data[0] : null;
                $value = StudentAccount::where('student_number', $data)->first();
                $value = StudentDetails::find($value->id);
                $designated = $value->enrollment_assessment ?  $value->enrollment_assessment->year_level() . " " . $value->enrollment_assessment->course->course_code : '';
                $borrowbook = borrowpage::where('bookstatus', 'onlend')->where('borrower', $data)->get();
            } else {
                $data = null;
                $borrowbook = [];
            }
        }
        return view('books.lost_damage_page', compact('books', 'value', 'designated', 'borrowbook'));
    }

    public function store(Request $request)
    {
        $value = [];
        if ($request->data) {
            $word = 'employee';
            if (strpos($request->data, $word) !== false) {
                // Employee
                $data = explode(":", $request->data);
                $data = count($data) > 1 ? $data[1] : str_replace($word, '', $request->data);
                $value = UserStaff::where('email', $data)->first();
                $value = $value->staff;
                foreach ($request->bookdata as $key => $books) {
                    $book = borrowpage::where('id', $books)->where('Borrower', $data);
                    $book->update(['bookstatus' => 'fine']);
                }
            } else if (strpos($request->data, $word) === false) {
                // Student
                $data = explode(".", $request->data);
                $data = count($data) > 1 ? $data[0] : null;
                $value = StudentAccount::where('student_number', $data)->first();
                $value = StudentDetails::find($value->id);
                foreach ($request->bookdata as $key => $books) {
                    $book = borrowpage::where('id', $books)->where('Borrower', $data);
                    $book->update(['bookstatus' => 'fine']);
                }
            }
        }
    }
}
