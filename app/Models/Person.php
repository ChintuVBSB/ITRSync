<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'gender',
        'dob',
        'address',
        'pan',
        'pan_attachment',
        'aadhar',
        'aadhar_attachment',
        'residential_status',
        'mobile',
        'email',
    ];
    protected $table = 'persons';
}
