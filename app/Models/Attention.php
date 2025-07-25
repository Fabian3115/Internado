<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attention extends Model
{
    use HasFactory;
    protected $fillable = [
        'apprentice_id',
        'date',
        'incident',
        'description',
        'observations',
        'recorded_by',
    ];

    public function apprentice()
    {
        return $this->belongsTo(Apprentice::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

}
