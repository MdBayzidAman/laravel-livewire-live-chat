<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'username',
        'provider',
        'provider_id',
        'provider_token',
        'email_verified_at',
        'password',
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
        'password' => 'hashed',
    ];

    // set default value of username
    protected static function boot()
    {
        parent::boot();

        // Define a creating event to generate a random username
        static::creating(function ($user) {
            $user->username = self::generateUsername($user->name);
        });
    }
    
    
    // Generate username
    public static function generateUsername($username){
        if ($username === null) {
            $username = Str::lower(Str::random(8));
        }

        if (User::where('username', $username)->exists()) {
            $newUsername = $username.Str::lower(Str::random(3));
            $username = self::generateUsername($newUsername);
        }
        return $username;
    }
}
