<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class purchasemodel extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendorid', 'requestedby', 'department', 'dateofdelivery', 'title', 'quantity', 'unitprice', 'status', 'createdby','receivedby'
    ];

    public function purchase()
    {
        return $this->belongsTo(purchasemodel::class, 'id');
    }
    public function computetotalprice($quantities, $unitprices)
    {
        return $quantities * $unitprices;
    }

    public function getVendorName($vendorId)
    {
        return vendortable::find($vendorId)->vendorname;
    }

    public function getVendorContact($vendorId)
    {
        return vendortable::find($vendorId)->vendorcontact;
    }

    
    public function puchasebook(){
        return $this->belongsTo(purchasemodel::class , 'id');
    }

}
