<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounterPrestation extends Model
{
    use HasFactory;

    protected $fillable = [
        'apprentice_id',
        'hours',
        'activity_date',
        'total_hours',
        'recorded_by',
    ];
    public function apprentice()
    {
        return $this->belongsTo(Apprentice::class);
    }

}
