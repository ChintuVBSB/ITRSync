<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IncomeFromCapitalGain extends Model
{
    use HasFactory;

    protected $fillable = [
        'submission_id',
        'demat_statements',
        'sale_deeds',
        'purchase_deeds',
        'improvement_expense_details',
    ];

    protected $casts = [
        'demat_statements' => 'array',
        'sale_deeds' => 'array',
        'purchase_deeds' => 'array',
    ];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }
}

