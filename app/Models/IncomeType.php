<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeType extends Model
{
    //
    protected $fillable = ['slug', 'label'];

    public function submissions()
    {
        return $this->belongsToMany(Submission::class);
    }
}
