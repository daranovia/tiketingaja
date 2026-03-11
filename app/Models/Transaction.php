<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =[
        'code',
        'flight_id',
        'flight_class_id',
        'name',
        'email',
        'phone',
        'number+of_pessengers',
        'payment_status',
        'subtotal',
        'grandtotal'
    ];

    public function flight(){
        return $this->belongsTo(Flight::class);
    }

    public function class(){
        return $this->belongsTo(FlightClass::class);
    }

    public function promotion(){
        return $this->belongsTo(PromoCode::class);
    }

    public function passenger(){
        return $this->hasMany(TransactionPassenger::class);
    }

}
