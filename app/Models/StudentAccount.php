<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAccount extends Model
{
    use HasFactory;
    protected $table = 'student_accounts';
    protected $connection = 'mysql-main'; // Call the Main Database
    function student()
    {
        return $this->belongsTo(StudentDetails::class, 'student_id');
    }
}
