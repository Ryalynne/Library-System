<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{

    use HasFactory;
    protected $connection = 'mysql-main';
    function profile_picture()
    {
        $_image = 'avatar.png';
        if ($this->user) {
            if (file_exists(public_path('assets/img/staff/' . strtolower(str_replace(' ', '_', $this->user->name)) . '.jpg'))) {
                $_image = strtolower(str_replace(' ', '_', $this->user->name)) . '.jpg';
            }
        }
        return 'http:bma.edu.ph/assets/img/staff/' . $_image;
    }
}
