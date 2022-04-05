<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cpf',
        'birthday',
        'state',
        'city',
    ];

    public function redaction()
    {
        return $this->belongsTo(Redaction::class);
    }
}
