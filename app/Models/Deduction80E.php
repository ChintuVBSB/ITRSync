<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Deduction80E extends Model
{
    use HasFactory;
    protected $table = 'deductions_80e';
    protected $fillable = [
        'submission_id',
        'education_loan_interest_proofs',
    ];

    protected $casts = [
        'education_loan_interest_proofs' => 'array',
    ];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }
}
