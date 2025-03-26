<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'civility',
        'first_name',
        'last_name',
        'email',
        'phone',
        'zip_code',
        'city',
    ];

    /**
     * Relationships
     */
    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }
}
