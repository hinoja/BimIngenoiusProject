<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Newsletter extends Model
{
    use HasFactory, SoftDeletes;

    // Statuts possibles pour une newsletter
    const STATUS_DRAFT = 'draft';
    const STATUS_SCHEDULED = 'scheduled';
    const STATUS_SENDING = 'sending';
    const STATUS_SENT = 'sent';
    const STATUS_FAILED = 'failed';

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array
     */
    protected $fillable = [
        'subject',
        'content',
        'status',
        'scheduled_for',
        'sent_at',
        'recipients_count',
        'user_id',
    ];

    /**
     * Les attributs qui doivent être convertis en types natifs.
     *
     * @var array
     */
    protected $casts = [
        'scheduled_for' => 'datetime',
        'sent_at' => 'datetime',
    ];

    /**
     * Obtenir l'utilisateur qui a créé la newsletter.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Vérifier si la newsletter est en brouillon.
     *
     * @return bool
     */
    public function isDraft()
    {
        return $this->status === self::STATUS_DRAFT;
    }

    /**
     * Vérifier si la newsletter est programmée.
     *
     * @return bool
     */
    public function isScheduled()
    {
        return $this->status === self::STATUS_SCHEDULED;
    }

    /**
     * Vérifier si la newsletter est en cours d'envoi.
     *
     * @return bool
     */
    public function isSending()
    {
        return $this->status === self::STATUS_SENDING;
    }

    /**
     * Vérifier si la newsletter a été envoyée.
     *
     * @return bool
     */
    public function isSent()
    {
        return $this->status === self::STATUS_SENT;
    }

    /**
     * Vérifier si l'envoi de la newsletter a échoué.
     *
     * @return bool
     */
    public function isFailed()
    {
        return $this->status === self::STATUS_FAILED;
    }

    /**
     * Vérifier si la newsletter peut être envoyée.
     *
     * @return bool
     */
    public function canBeSent(): bool
    {
        return $this->isDraft() || $this->isScheduled();
    }

    public function getStatusColorAttribute()
    {
        return [
            self::STATUS_DRAFT => 'secondary',
            self::STATUS_SCHEDULED => 'info',
            self::STATUS_SENDING => 'primary',
            self::STATUS_SENT => 'success',
            self::STATUS_FAILED => 'danger',
        ][$this->status] ?? 'secondary';
    }
}

