<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'apprentice_id',
        'reason',
        'departure_date',
        'return_date',
        'destination',
        'observations',
        'status',
        'user_id',
        'comment'
    ];
}
