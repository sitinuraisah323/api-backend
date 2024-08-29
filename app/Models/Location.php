<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $fillable = [
        'event_name',
        'event_date',
        'location_name',
        'location_address',
        'location_image',
        'latitude',
        'longitude',
        'header_id'
    ];
}
