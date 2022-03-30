<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IllustrateRedaction extends Model
{
    use HasFactory;

    public function illustrations()
    {
        return $this->belongsTo(Redaction::class);
    }
    public function illustrator()
    {
        return $this->belongsTo(Illustrator::class);
    }
}
