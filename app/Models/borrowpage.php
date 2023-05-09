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
        'bookid', 'studentid', 'bookstatus', 'duedate','penalty'
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
        $endDate = new DateTime(now());

        $interval = $startDate->diff($endDate);
        $days = $interval->days;

        for ($i = 0; $i <= $interval->days; $i++) {
            $date = $startDate->modify('+1 day');
            $dayOfWeek = $date->format('N');
            if ($dayOfWeek >= 6) {
                $days--;
            }
        }

        if ($days > 1) {
            return $days . ' Days';
        } else {
            return $days . ' Day';
        }
    }
}
