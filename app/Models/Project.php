<?php

namespace App\Models;

use Carbon\Carbon;
use App\Enums\SizeEnums;
use App\Enums\StatusEnums;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = ['fr_title', 'en_title', 'fr_slug', 'en_slug', 'fr_description', 'fr_description', 'company', 'country', 'city', 'address', 'start_date', 'end_date', 'category_id'];

    protected $casts = [
        'status' => StatusEnums::class,
        'size' => SizeEnums::class,
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function getRouteKeyName()
    {
        return app()->getLocale() . '_slug';
    }

    public function setFrTitleAttribute($value)
    {
        $this->attributes['fr_title'] = $value;
        $this->attributes['fr_slug'] = Str::slug($value);
    }

    public function setEnTitleAttribute($value)
    {
        $this->attributes['en_title'] = $value;
        $this->attributes['en_slug'] = Str::slug($value);
    }

    public function getTitleAttribute()
    {
        return app()->getLocale() . '_title';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getFormattedStartDateAttribute()
    {
        return Carbon::parse($this->start_date)->locale(app()->getLocale())->isoFormat('LL');
    }

    public function getFormattedEndDateAttribute()
    {
        return Carbon::parse($this->end_date)->locale(app()->getLocale())->isoFormat('LL');
    }

    public function getDurationAttribute()
    {
        $start = Carbon::parse($this->start_date);
        $end = Carbon::parse($this->end_date);
        return $start->diffForHumans($end);
    }
}
