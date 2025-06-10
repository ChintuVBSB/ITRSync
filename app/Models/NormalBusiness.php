<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NormalBusiness extends Model
{
    use HasFactory;

    protected $fillable = [
        'income_from_business_id',
        'total_sales',
        'total_expenses',
        'pl_statement',
    ];

    public function incomeFromBusiness()
    {
        return $this->belongsTo(IncomeFromBusiness::class);
    }
}
