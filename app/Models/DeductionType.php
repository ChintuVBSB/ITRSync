<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeductionType extends Model
{
    //
    use HasFactory;
    protected $fillable = ["slug", "label"];

    public function submissions(){
        return $this->belongsToMany(Submission::class);
    }
}
