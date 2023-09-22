<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDetails extends Model
{
    use HasFactory;
    protected $table = 'student_details';
    protected $connection = 'mysql-main'; // Call the Main Database


    function account()
    {
        return $this->hasOne(StudentAccount::class, 'student_id');
    }
    function enrollment_assessment()
    {
        $academic = AcademicYear::where('is_active', true)->first();
        return $this->hasOne(EnrollmentAssessment::class, 'student_id')->where('academic_id', $academic->id);
    }
    public function borrow_books()
    {
        return $this->hasMany(borrowpage::class, 'studentid')->where('bookstatus', 'onlend')->where('ishide', false);
    }

    public function profile_picture()
    {
        $_formats = ['.jpeg', '.jpg', '.png'];
        $_path = 'http://bma.edu.ph/img/student-picture/';
        $_image = 'http://bma.edu.ph/img/student-picture/midship-man.jpg';
        foreach ($_formats as $format) {
            $_image = @fopen($_path . $this->account->student_number . $format, 'r') ? $_path . $this->account->student_number . $format : $_image;
        }
        return $_image;
    }
}
