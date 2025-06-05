<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IncomeType extends Model
{
    //
    protected $fillable = ['slug', 'label'];

    public function submission(): BelongsTo
    {
    return $this->belongsTo(Submission::class);
    }
}
