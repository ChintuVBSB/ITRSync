<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FirmIncome extends Model
{
    use HasFactory;

    protected $fillable = [
        'income_from_business_id',
        'name_pan',
        'share_percent',
        'remuneration',
        'interest',
        'profit_or_loss',
        'closing_balance',
    ];

    public function incomeFromBusiness()
    {
        return $this->belongsTo(IncomeFromBusiness::class);
    }
}
