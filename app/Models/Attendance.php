<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;


    protected $fillable = [
        'check_in',
        'check_out',
        'qr_code',
        'user_id',
        'present',
        'progress',
        'month',
        'year'
    ];


}
