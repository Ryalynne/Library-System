<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrollmentAssessment extends Model
{
    use HasFactory;
    protected $table = 'enrollment_assessments';
    protected $connection = 'mysql-main'; // Call the Main Database

    function student()
    {
        return $this->belongsTo(StudentDetails::class, 'student_id');
    }
    function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    function year_level()
    {
        $level = $this->year_level == 11 ? 'Grade 11' : '';
        $level = $this->year_level == 12 ? 'Grade 12' : $level;
        $level = $this->year_level == 1 ? '1st Class' : $level;
        $level = $this->year_level == 2 ? '2nd Class' : $level;
        $level = $this->year_level == 3 ? '3rd Class' : $level;
        $level = $this->year_level == 4 ? '4th Class' : $level;
        return $level;
    }
}
