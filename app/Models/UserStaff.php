<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStaff extends Model
{
    use HasFactory;
    protected $connection = 'mysql-main';
    protected $table = "users";

    function staff()
    {
        return $this->hasOne(Staff::class, 'user_id');
    }
}
