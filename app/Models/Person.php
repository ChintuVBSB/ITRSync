<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BankDetail;

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

    public function user()  
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function bankDetails()
    {
        return $this->hasMany(BankDetail::class);
    }
}
