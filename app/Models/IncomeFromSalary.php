<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IncomeFromSalary extends Model
{
    use HasFactory;

    protected $fillable = [
        'submission_id',
        'form_16',
        'salary_slips',
        'arrear_sheets',
        'employer_pan',
        'employer_address',
        'salary_amount',
        'hra_rent_paid',
        'hra_city',
        'hra_landlord_name',
        'hra_property_address',
    ];

    protected $casts = [
        'form_16' => 'array',
        'salary_slips' => 'array',
        'arrear_sheets' => 'array',
    ];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }
}
