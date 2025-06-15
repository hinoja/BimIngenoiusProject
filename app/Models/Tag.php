<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = ['fr_name', 'en_name', 'slug'];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Accesseur pour obtenir le nom dans la langue actuelle
    public function getNameAttribute()
    {
        return $this->{app()->getLocale() . '_name'};
    }

    // Mutateur pour définir automatiquement le slug à partir du nom anglais
    public function setEnNameAttribute($value)
    {
        $this->attributes['en_name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function projects()
    {
        return $this->morphedByMany(Project::class, 'taggable');
    }

    public function news()
    {
        return $this->morphedByMany(News::class, 'taggable');
    }
}

