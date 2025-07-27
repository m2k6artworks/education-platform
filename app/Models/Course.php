<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

class Course extends Model
{
    protected $fillable = [
        'title', 'description', 'thumbnail', 'status', 'user_id', 'price', 'original_price', 'level', 'category_id',
        'content_type', 'video_path', 'video_url', 'audio_path', 'pdf_path'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function contents(): HasMany
    {
        return $this->hasMany(CourseContent::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id');
    }

    public function getStudentsCountAttribute()
    {
        return $this->students()->count();
    }

    // Tambahkan relasi creator agar lebih jelas
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Delete a file from storage if it exists
     */
    public function deleteFile($field)
    {
        if ($this->$field && $this->$field !== '-') {
            Storage::disk('public')->delete($this->$field);
            $this->$field = null;
        }
    }

    /**
     * Delete all course files
     */
    public function deleteAllFiles()
    {
        $this->deleteFile('thumbnail');
        $this->deleteFile('video_path');
        $this->deleteFile('audio_path');
        $this->deleteFile('pdf_path');
    }

    /**
     * Clear all content fields except the specified one
     */
    public function clearOtherContentFields($keepField = null)
    {
        $contentFields = ['video_path', 'video_url', 'audio_path', 'pdf_path'];
        
        foreach ($contentFields as $field) {
            if ($field !== $keepField) {
                if (str_contains($field, '_path')) {
                    $this->deleteFile($field);
                } else {
                    $this->$field = null;
                }
            }
        }
    }

    /**
     * Get the content file URL if it exists
     */
    public function getContentFileUrl($field)
    {
        if ($this->$field && $this->$field !== '-') {
            return Storage::disk('public')->url($this->$field);
        }
        return null;
    }

    /**
     * Check if course has a specific content type file
     */
    public function hasContentFile($field)
    {
        return $this->$field && $this->$field !== '-';
    }
}