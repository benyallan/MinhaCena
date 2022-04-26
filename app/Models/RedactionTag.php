<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RedactionTag extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'redaction_id',
        'tag_id',
    ];

    public function redactions()
    {
        return $this->belongsToMany(Redaction::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
