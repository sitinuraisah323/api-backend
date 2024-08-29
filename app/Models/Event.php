<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'groom', 'bride', 'contract_date', 'place_of_contract', 'reception_date', 'place_reception', 'header_id'
    ];
}
