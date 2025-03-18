<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Contact extends Model
{
    /** @use HasFactory<\Database\Factories\ContactFactory> */
    use HasFactory,Notifiable;

    //Mass ASSIGNMENT
    protected $fillable = [
        'name', 'email', 'subject', 'message', 'response',
    ];

    // ACCESSORS
    public function getCreatedAtAttribute($created_at)
    {
        return $this->getFormatedDateTime($created_at);
    }

    public function getUpdatedAtAttribute($updated_at)
    {
        return $this->getFormatedDateTime($updated_at);
    }

    function getFormatedDateTime($date)
    {
        $locale = app()->getLocale();
        Carbon::setLocale($locale);
        $format = $locale === 'en' ? 'F d, Y, H:i' : 'd M Y, H:i';

        return Carbon::parse($date)->translatedFormat($format);
    }
}
