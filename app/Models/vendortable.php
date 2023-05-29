<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vendortable extends Model
{
    use HasFactory;
    protected $fillable =[
        'vendorname','vendorcontact'
    ];
    public function vendor()
    {
        return $this->belongsTo(vendortable::class, 'id');
    }
    
}
