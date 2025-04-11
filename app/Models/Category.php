<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = ['fr_name','en_name',"slug", 'description', 'image'];
    protected $casts = [
        'deleted_at' => 'datetime',
    ];
    protected $attributes = [
        'image' => null,
    ];
    public function getTitleAttribute()
    {
        return $this->{app()->getLocale() . '_name'};
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }
}
