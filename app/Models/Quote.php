<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'category_id',
        'title',
        'details',
        'budget',
        'currency',
        'project_city',
        'file',
        'quotable_id',
        'quotable_type',
        'response',
        'response_budget',
        'response_currency',
        'response_at',
    ];

    const CIVILITY = [
        'Mrs' => 'Madam',
        'Mr' => 'Sir',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }


    public function quotable()
    {
        return $this->morphTo();
    }

    public function getDateAttribute($date)
    {
        return $this->getFormatedDateTime($date);
    }

    public function getCreatedAtAttribute($created_at)
    {
        return $this->getFormatedDateTime($created_at);
    }

    public function getUpdatedAtAttribute($updated_at)
    {
        return $this->getFormatedDateTime($updated_at);
    }
    public function getResponseAtAttribute($response_at)
    {
        return $this->getFormatedDateTime($response_at);
    }

    protected function getFormatedDateTime($date)
    {
        $locale = app()->getLocale();
        Carbon::setLocale($locale);
        $format = $locale === 'en' ? 'F d, Y' : 'd M Y';

        return Carbon::parse($date)->translatedFormat($format);
    }
}
