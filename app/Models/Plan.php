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
    public $fillable =['fr_title', 'en_title', 'slug', 'user_id', 'image', 'is_active','published_at'];

    // RELATIONSHIPS
    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
