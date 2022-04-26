<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Illustrator extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'cpf',
        'birthday',
        'state',
        'city',
        'portfolio',
        'unlocked_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function socialMedias()
    {
        return $this->hasMany(SocialMedia::class);
    }

    public function redactions()
    {
        return $this->belongsToMany(Redaction::class);
    }
}
