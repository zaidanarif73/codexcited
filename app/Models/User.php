<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

use App\Enums\UserEnum;
use App\Enums\RoleEnum;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'avatar',
        'status',
        'email_verified_at',
        'remember_token',
        'last_seen',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'last_seen' => 'datetime',
    ];

    public function isOnline()
    {
        return $this->last_seen && $this->last_seen->diffInMinutes(now()) <= 5;
    }

    public function status()
    {
        $return = null;
        switch ($this->status) {
            case UserEnum::STATUS_ACTIVE:
                $return = (object) [
                    'class' => 'success',
                    'msg' => 'Aktif',
                ];
                break;

            case UserEnum::STATUS_INACTIVE:
                $return = (object) [
                    'class' => 'warning',
                    'msg' => 'Tidak Aktif',
                ];
                break;
        }

        return $return;
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasRole(RoleEnum::SuperAdmin);
    }
    public function isTeacher(): bool
    {
        return $this->hasRole(RoleEnum::Teacher);
    }
    public function isStudent(): bool
    {
        return $this->hasRole(RoleEnum::Student);
    }
}
