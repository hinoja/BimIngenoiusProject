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
        'avatar',
        'role_id',
        'slug',
        'is_active',
        'email_verified_at',
        'disabled_by',
        'disabled_at',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
        'disabled_at' => 'datetime',
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
     * Get the user's avatar URL.
     *
     * @return string
     */

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
    public function canLogin(): bool
    {
        return $this->is_active || (! $this->is_active && $this->disabled_by === $this->id);
    }

    public function getAvatarAttribute($value)
    {
        // Si l'utilisateur a un avatar et que le fichier existe dans le disque public
        if ($value && Storage::disk('public')->exists($value)) {
            return Storage::url($value);
        }

        // Sinon, retourne l'avatar par défaut cohérent pour toutes les vues
        return asset('assets/back/img/avatar/avatar-1.png');
    }
    /**
     * Vérifie si l'utilisateur a un rôle spécifique.
     */
    public function hasRole($roleName)
    {
        return $this->role->name === $roleName;
    }
}
