<?php

namespace App\Models;

use DateTime;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class borrowpage extends Model
{
    use HasFactory;

    protected $fillable = [
        'bookid', 'studentid', 'bookstatus', 'duedate'
    ];

    public function book()
    {
        return $this->belongsTo(booklist::class, 'bookid');
    }

    public function student()
    {
        return $this->belongsTo(studentlist::class, 'studentid');
    }

    public function penalty($duedate)
    {
        $startDate = new DateTime($duedate);
        $endDate = new DateTime(now()->format('Y-m-d'));
        
        $interval = $startDate->diff($endDate);
        $days = $interval->days;
        
        for ($i = 1; $i <= $interval->days; $i++) {
            $date = $startDate->modify('+1 day');
            $dayOfWeek = $date->format('N');
            if ($dayOfWeek >= 6) { // Saturday (6) or Sunday (7)
                $days--;
            }
        }
        return $days.' Days';
    }
    
}
