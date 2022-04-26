<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag',
        'administrator_id',
    ];

    public function redactions()
    {
        return $this->belongsToMany(Redaction::class);
    }
}
