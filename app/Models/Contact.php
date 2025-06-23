<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;


class Contact extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'response',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function getCreatedAtAttribute($created_at)
    {
        return $this->getFormatedDateTime($created_at);
    }
    function getFormatedDateTime($date)
    {
        $locale = app()->getLocale();
        Carbon::setLocale($locale);
        $format = $locale === 'en' ? 'F d, Y   H:i' : 'd M Y  H:i';

        return Carbon::parse($date)->translatedFormat($format);
    }
    /**
     * Route notifications for the mail channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return array|string
     */
    public function routeNotificationForMail($notification)
    {
        return $this->email;
    }
}
