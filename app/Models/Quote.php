<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Quote extends Model
{
    /** @use HasFactory<\Database\Factories\QuoteFactory> */
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'category_id',
        'title',
        'details',
        'budget',
        'currency',
        'project_city',
        'file',
    ];

    const CIVILITY = [
        'Mrs' => 'Mrs',
        'Mr' => 'Mr',
    ];

    /**
     * Relationships
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
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

    function getFormatedDateTime($date)
    {
        $locale = app()->getLocale();
        Carbon::setLocale($locale);
        $format = $locale === 'en' ? 'F d, Y' : 'd M Y ';

        return Carbon::parse($date)->translatedFormat($format);
    }
}
