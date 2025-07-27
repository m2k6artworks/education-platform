<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name', 'description', 'icon', 'color'
    ];

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function getCoursesCountAttribute()
    {
        return $this->courses()->count();
    }
} 