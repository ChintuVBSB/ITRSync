<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Deduction80C extends Model
{
    use HasFactory;
    protected $table = 'deductions_80c';
    protected $fillable = [
        'submission_id',
        'life_insurance_receipts',
        'ppf_statements',
        'epf_statements',
        'mutual_fund_fds',
        'tuition_fee_receipts',
        'other_investment_proofs',
    ];

    protected $casts = [
        'life_insurance_receipts' => 'array',
        'ppf_statements' => 'array',
        'epf_statements' => 'array',
        'mutual_fund_fds' => 'array',
        'tuition_fee_receipts' => 'array',
        'other_investment_proofs' => 'array',
    ];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }
}
