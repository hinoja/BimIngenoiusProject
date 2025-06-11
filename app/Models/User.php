<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'slug',
        'is_active',
        'avatar',
        'role_id',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function plans()
    {
        return $this->hasMany(Plan::class);
    }

    public function news()
    {
        return $this->hasMany(News::class);
    }
/**
     * Check if disabled account can login
     *
     * @return bool
     * 
     */
    public function canLogin() : bool
    {
        return $this->is_active || (! $this->is_active && $this->disabled_by === $this->id);
    }

    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar && Storage::disk('public')->exists($this->avatar)) {
            return Storage::url($this->avatar);
        }
            return asset('assets/front/images/avatar1.png');
     
    }
}
