<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apprentice extends Model
{
    use HasFactory;
    protected $fillable = [
        'benefit_id',
        'person_id',
        'program_id',
        'state',
        'Tutor_name',
        'Tutor_last_name',
        'Tutor_number_phone',
    ];

    public function benefit()
    {
        return $this->belongsTo(Benefit::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function attentions()
    {
        return $this->hasMany(Attention::class);
    }
    
    public function counterPrestations()
    {
        return $this->hasMany(CounterPrestation::class);
    }
}
