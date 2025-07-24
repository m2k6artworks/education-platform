<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseContent extends Model
{
    protected $fillable = [
        'course_id', 'content', 'content_type', 'file_path', 'video_url'
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
