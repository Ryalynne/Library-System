<?php

namespace App\Models;

use App\Http\Controllers\Returnpage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booklist extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'author', 'copyright', 'accession', 'department', 'subject', 'callnumber'
    ];
    public function numberofcopies()
    {
        $data = $this->hasMany(copies::class, 'bookid')->where('action', 'lessen')->sum('copies');
        $borrow = $this->hasMany(borrowpage::class, 'bookid')->where('bookstatus', 'onlend')->count();
        $fine = $this->hasMany(borrowpage::class, 'bookid')->where('bookstatus', 'fine')->count();
        $minis = $data + $borrow + $fine;
        return  $this->hasMany(copies::class, 'bookid')->where('action', 'added')->sum('copies') - $minis;
    }


    public function getstatus($data)
    {
        // return $this->hasMany(borrowpage::class, 'studentid')->where('bookstatus', 'onlend')->value('bookstatus');
        // $account = StudentAccount::where('student_number', $id)->first();
        // return $this->hasMany(borrowpage::class, 'bookid')
        //     ->where('studentid', $account->student->id ?? null)
        //     ->where('bookstatus', 'onlend')
        //     ->value('bookstatus');
        //employee and student needed to be readed
        if ($data) {
            $word = 'employee';
            if (strpos($data, $word) !== false) {
                // Employee
                $data = explode(".", $data);
                $data = count($data) > 1 ? $data[0] : null;
                $value = UserStaff::where('email', $data)->first();
                return $this->hasMany(borrowpage::class, 'bookid')
                    ->where('borrower', $value->email ?? null)
                    ->where('bookstatus', 'onlend')
                    ->value('bookstatus');
            } else {
                // Student
                $data = explode(".", $data);
                $data = count($data) > 1 ? $data[0] : null;
                $value = StudentAccount::where('student_number', $data)->first();
                return $this->hasMany(borrowpage::class, 'bookid')
                    ->where('borrower', $value->student_number ?? null)
                    ->where('bookstatus', 'onlend')
                    ->value('bookstatus');
            }
        }
    }

    public function departments()
    {
        return $this->belongsTo(departmentList::class, 'department');
    }

    public function subjects()
    {
        return $this->belongsTo(subjectList::class, 'subject');
    }
}
