<?php

namespace App\Http\Controllers;

use App\Models\studentlist;
use App\Http\Requests\StorestudentlistRequest;
use App\Http\Requests\UpdatestudentlistRequest;
use App\Models\StudentAccount;

class StudentlistController extends Controller
{
    public function get_student($studentno)
    {
        $studentno = StudentAccount::where('student_number', $studentno)->first();
        if ($studentno) {
            return compact('studentno');
        } else {
            return "No student found with the provided student number.";
        }
    }
}
