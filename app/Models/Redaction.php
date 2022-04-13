<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'student',
        'school_id',
        'teacher_id',
        'composing',
    ];

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }

    public function school()
    {
        return $this->hasOne(School::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
