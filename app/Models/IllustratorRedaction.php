<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class IllustratorRedaction extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'delivered_at',
        'illustration',
        'unlocked_at',
    ];
}
