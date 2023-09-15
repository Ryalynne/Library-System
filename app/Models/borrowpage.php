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
        'bookid', 'studentid', 'bookstatus', 'duedate', 'penalty','transaction', 'borrower'
    ];

    public function book()
    {
        return $this->belongsTo(booklist::class, 'bookid');
    }

    public function student()
    {
        return $this->belongsTo(StudentDetails::class, 'studentid');
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


    public function returnpenalty($duedate, $endDate){
   
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
