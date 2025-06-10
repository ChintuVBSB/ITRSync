<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeductionOtherDocument extends Model
{
    use HasFactory;
    protected $table = 'deductions_other_documents';
    protected $fillable = [
        'submission_id',
        'other_deduction_documents',
    ];

    protected $casts = [
        'other_deduction_documents' => 'array',
    ];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }
}
