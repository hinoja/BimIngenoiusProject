<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    /** @use HasFactory<\Database\Factories\NewsFactory> */
    use HasFactory, SoftDeletes;
    // MASS ASSIGNMENT
    public $fillable = ['fr_title', 'en_title', 'fr_content', 'en_content', 'slug', 'image', 'user_id', 'published_at'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
 
    // RELATIONSHIPS
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    // ACCESSORS
    public function getTitleAttribute()
    {
        return $this->{app()->getLocale() . '_title'};
    }

    public function getContentAttribute()
    {
        return $this->{app()->getLocale() . '_content'};
    }

    public function getMediumContentAttribute()
    {
        return Str::words($this->content, 40);
    }

    public function getImageAttribute($image)
    {
        return $image ? asset('storage/news/' . $image) : asset('assets/defaults/news/news-' . rand(1, 6) . '.jpg');
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
        $format = $locale === 'en' ? 'F d, Y' : 'd M Y';

        return Carbon::parse($date)->translatedFormat($format);
    }
}
