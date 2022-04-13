<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Illustrator extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cpf',
        'birthday',
        'state',
        'city',
        'portfolio',
        'socialMedias',
    ];

    public function user()
    {
        return $this->morphOne(User::class, 'data');
    }
}
