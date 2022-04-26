<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class redaction_illustrations extends Model
{
    use HasFactory;

    protected $fillable = [
        'delivered_at',
        'illustration',
        'unlocked_at',
    ];
}
