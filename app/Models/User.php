<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'user_type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function thisUser()
    {
        switch ($this->user_type) {
            case 'Administrator':
                return DB::table('administrators')->where('user_id', $this->id)->get();
                break;
            case 'Teacher':
                $teachers = DB::table('teachers')
                    ->where('user_id', $this->id)->get();
                return $teachers->first()->id;
                break;
            case 'Illustrator':
                $illustrators = DB::table('illustrators')
                    ->where('user_id', $this->id)->get();
                return $illustrators->first()->id;
                break;

            default:
                return null;
                break;
        }
    }
}
