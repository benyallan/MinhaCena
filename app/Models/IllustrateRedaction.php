<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IllustrateRedaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'redaction_id',
        'illustrator_id',
        'delivered_at',
        'illustration',
        'unlocked_at',
    ];

    public function illustrations()
    {
        return $this->belongsTo(Redaction::class);
    }
    public function illustrator()
    {
        return $this->belongsTo(Illustrator::class);
    }
}
