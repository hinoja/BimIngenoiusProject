<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'news';

    protected $fillable = [
        'fr_title',
        'en_title',
        'fr_content',
        'en_content',
        'slug',
        'image',
        'published_at',
        'user_id'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'news_tag');
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
                    ->where('published_at', '<=', now());
    }

    public function getTitle()
    {
        $locale = app()->getLocale();
        return $locale === 'fr' ? $this->fr_title : $this->en_title;
    }

    public function getContent()
    {
        $locale = app()->getLocale();
        return $locale === 'fr' ? $this->fr_content : $this->en_content;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}



