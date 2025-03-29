<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    /** @use HasFactory<\Database\Factories\ImageFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    public function imageable()
    {
        return $this->morphTo();
    }

    public function getPathAttribute()
    {
        return $this->name ? asset('storage/projects/' . $this->name) : asset('assets/defaults/projects/project-' . rand(1, 1) . '.jpg');
    }
}
