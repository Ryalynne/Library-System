<?php

namespace App\Models;

use DateTime;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class borrowpage extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $fillable = [
        'bookid', 'studentid', 'bookstatus', 'duedate', 'penalty', 'transaction', 'borrower'
    ];

    public function book()
    {
        return $this->belongsTo(booklist::class, 'bookid');
    }
    public function student()
    {
        return $this->belongsTo(StudentDetails::class, 'studentid');
    }

    function staff_list($email)
    {
        return UserStaff::where('users.email', $email)
            ->join('staff', 'staff.user_id', 'users.id')->select('staff.last_name', 'staff.first_name', 'staff.department')->first();
    }

    function student_list($id)
    {
        $student = StudentAccount::where('student_number', $id)->first();

        if ($student !== null) {
            $studentDetails = StudentDetails::select('first_name', 'middle_name', 'last_name', 'id')
                ->where('id', $student->id)
                ->first();

            if ($studentDetails !== null) {

                $year_level = EnrollmentAssessment::where('student_id', $studentDetails->id)->first();
                $level = '';

                if ($year_level->year_level == '11') {
                    $level = 'Grade 11';
                } elseif ($year_level->year_level == '12') {
                    $level = 'Grade 12';
                } elseif ($year_level->year_level == '1') {
                    $level = '1st Class';
                } elseif ($year_level->year_level == '2') {
                    $level = '2nd Class';
                } elseif ($year_level->year_level == '3') {
                    $level = '3rd Class';
                } elseif ($year_level->year_level == '4') {
                    $level = '4th Class';
                }

                return "{$studentDetails->first_name} {$studentDetails->middle_name} {$studentDetails->last_name}, {$level}";
            }
        }
        return null;
    }




    public function penalty($duedate)
    {
        $startDate = new DateTime($duedate);
        $endDate = new DateTime(now());

        if ($startDate > $endDate) { // book is not overdue yet
            return '0 Day';
        }

        $interval = $startDate->diff($endDate);
        $days = $interval->days + 1; // add 1 day for initial due date

        for ($i = 0; $i <= $interval->days; $i++) {
            $date = $startDate->modify('+1 day');
            $dayOfWeek = $date->format('N');
            if ($dayOfWeek == 6 || $dayOfWeek == 7) { // subtract days only for Saturdays and Sundays
                $days--;
            }
        }

        if ($days > 0) {
            $days--;
            return $days . ' Day';
        } else {
            return $days . ' Days';
        }
    }


    public function returnpenalty($duedate, $endDate)
    {

        $startDate = new DateTime($duedate);
        $endDate = new DateTime($endDate);

        if ($startDate > $endDate) { // book is not overdue yet
            return '0 Day';
        }

        $interval = $startDate->diff($endDate);
        $days = $interval->days + 1; // add 1 day for initial due date

        for ($i = 0; $i <= $interval->days; $i++) {
            $date = $startDate->modify('+1 day');
            $dayOfWeek = $date->format('N');
            if ($dayOfWeek == 6 || $dayOfWeek == 7) { // subtract days only for Saturdays and Sundays
                $days--;
            }
        }

        if ($days > 0) {
            $days--;
            return $days . ' Day';
        } else {
            return $days . ' Days';
        }
    }
}
