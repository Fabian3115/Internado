<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'apprentice_id',
        'attendance_date',
        'attendance_status',
        'justification',
    ];

    public function apprentice()
    {
        return $this->belongsTo(Apprentice::class);
    }


}
