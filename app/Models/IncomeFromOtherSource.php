<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeFromOtherSource extends Model
{
    use HasFactory;

    protected $fillable = [
        'submission_id',
        'interest_certificate',
        'dividend_company',
        'dividend_amount',
        'other_party_name',
        'other_party_amount',
        'crypto_statement',
        'other_description',
        'other_amount',
    ];
}
