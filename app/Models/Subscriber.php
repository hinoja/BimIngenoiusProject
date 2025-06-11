<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Subscriber extends Model
{
    use HasFactory, SoftDeletes;

    // Statuts possibles pour un abonné
    const STATUS_ACTIVE = 'active';
    const STATUS_UNSUBSCRIBED = 'unsubscribed';
    const STATUS_BOUNCED = 'bounced';

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'name',
        'status',
        'token',
        'subscribed_at',
        'unsubscribed_at',
    ];

    /**
     * Les attributs qui doivent être convertis en types natifs.
     *
     * @var array
     */
    protected $casts = [
        'subscribed_at' => 'datetime',
        'unsubscribed_at' => 'datetime',
    ];

    /**
     * Vérifier si l'abonné est actif.
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    /**
     * Vérifier si l'abonné s'est désabonné.
     *
     * @return bool
     */
    public function isUnsubscribed(): bool
    {
        return $this->status === self::STATUS_UNSUBSCRIBED;
    }

    /**
     * Vérifier si l'email de l'abonné a rebondi.
     *
     * @return bool
     */
    public function isBounced(): bool
    {
        return $this->status === self::STATUS_BOUNCED;
    }

    /**
     * Générer un token unique pour l'abonné.
     *
     * @return string
     */
    public static function generateToken(): string
    {
        return Str::random(32);
    }

    /**
     * Trouver un abonné par son token.
     *
     * @param string $token
     * @return self|null
     */
    public static function findByToken(string $token): ?self
    {
        return self::where('token', $token)->first();
    }

    public function getUnsubscribeUrl()
    {
        return route('newsletters.unsubscribe', ['token' => $this->token]);
    }
}

