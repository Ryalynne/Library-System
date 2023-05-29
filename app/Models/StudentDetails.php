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
    public function borrow_books(){
        return $this->hasMany(borrowpage::class , 'studentid')->where('bookstatus', 'onlend')->where('ishide',false);
    }
}
