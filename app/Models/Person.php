<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
        'type_document',
        'number_document',
        'number_phone',
        'gender',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->last_name}";
    }


    public function apprentices()
    {
        return $this->hasMany(Apprentice::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }


}
