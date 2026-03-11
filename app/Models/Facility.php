<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'image',
        'description'

    ];

    public function classes(){
        return $this->belongsToMany(FlightClass::class, 'flight_class_facility', 'flight_class_id', 'facility_id');
    }

}
