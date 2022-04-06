<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cpf',
        'birthday',
        'state',
        'city',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
