<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory;

    protected $table = 'pharmacies';

    protected $fillable = [
        'pharmacy_name',
        'date_from',
        'date_to',
        'day',
        'employee',
        'start_time',
        'end_time',
    ];

}
