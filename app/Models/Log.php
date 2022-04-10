<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'redaction_id',
        'where',
        'who',
    ];

    public function redaction()
    {
        return $this->belongsTo(Redaction::class);
    }
}
