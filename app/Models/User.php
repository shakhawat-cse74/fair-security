<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasRoles, HasApiTokens, HasFactory, HasProfilePhoto, Notifiable;

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'session_id',
        'ip_address',
        'device_id',
        'is_guest',
    ];

    /**
     * Hidden attributes for serialization
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * Appended attributes
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Attribute casting
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_guest' => 'boolean',
        'last_active' => 'datetime',
    ];

    /**
     * Accessor for avatar/profile photo
     */
    public function getAvatarAttribute($avatar)
    {
        if ($this->profile_photo_path && Storage::exists('public/profile_photos/' . $this->profile_photo_path)) {
            return asset('storage/profile_photos/' . $this->profile_photo_path);
        }

        return asset('images/default-avatar.png');
    }

    /**
     * Relationships
     */
    public function discussions(): HasMany
    {
        return $this->hasMany(Discussion::class);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class);
    }

    public function reactions(): HasMany
    {
        return $this->hasMany(Reaction::class);
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(SystemNotification::class);
    }
}
