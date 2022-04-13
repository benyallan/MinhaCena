<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'contactPerson',
        'type',
        'street',
        'number',
        'state',
        'city',
    ];

    public function user()
    {
        return $this->morphOne(User::class, 'data');
    }

    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }
}
