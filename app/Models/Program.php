<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    protected $fillable = [
        'program_name',
        'technical_sheet',
        'level',
        'initials',
        'mode',
    ];

    public function apprentices()
    {
        return $this->hasMany(Apprentice::class);
    }

}
