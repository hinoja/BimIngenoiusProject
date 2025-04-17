<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    /** @use HasFactory<\Database\Factories\PlanFactory> */
    use HasFactory,SoftDeletes;

    // MASS ASSIGNMENT
    public $fillable =['fr_title', 'en_title', 'slug', 'fr_description', 'en_description', 'user_id', 'image', 'image2D','published_at'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // RELATIONSHIPS
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

      // ACCESSORS
    public function getTitleAttribute()
    {
        return $this->{app()->getLocale() . '_title'};
    }

    public function getDescriptionAttribute()
    {
        return $this->{app()->getLocale() . '_description'};
    }

    public function getImageAttribute()
    {
        return $this->images->first() ? $this->images->first()->path : asset('assets/defaults/plans/plan-' . rand(1, 2) . '.jpg');
    }

    public function getCreatedAtAttribute($created_at)
    {
        return $this->getFormatedDateTime($created_at);
    }

    public function getUpdatedAtAttribute($updated_at)
    {
        return $this->getFormatedDateTime($updated_at);
    }
    public function getPublishedAtAttribute($published_at)
    {
        return $this->getFormatedDateTime($published_at);
    }

    function getFormatedDateTime($date)
    {
        $locale = app()->getLocale();
        Carbon::setLocale($locale);
        $format = $locale === 'en' ? 'F d, Y' : 'd M Y ';

        return Carbon::parse($date)->translatedFormat($format);
    }
}
