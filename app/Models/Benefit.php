<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    use HasFactory;

    protected $fillable = [
        'percentage',
        'total_hours',
    ];
    public function apprentices()
    {
        return $this->hasMany(Apprentice::class);
    }


}
