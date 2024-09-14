<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public const ROLE_ADMIN = 'ADMIN';
    public const ROLE_DEVELOPER = 'DEVELOPER';
    public const ROLE_USER = 'USER';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo',
        'role'
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

    protected $appends = ['profile_photo_url'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function profilePhotoUrl(): Attribute
    {
        $url = "";

        if ($this->profile_photo) {
            $url = asset('storage/' . $this->profile_photo);
        } else {
            $hash = md5(strtolower(trim($this->attributes['email'])));
            $url = "https://www.gravatar.com/avatar/$hash";
        }

        return Attribute::make(
            get: fn() => $url
        );
    }

    public function builds()
    {
        return $this->hasMany(Build::class);
    }

    public function approvedBuilds()
    {
        return $this->builds()->approved();
    }
}
