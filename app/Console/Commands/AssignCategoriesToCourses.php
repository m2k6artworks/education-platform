<?php

namespace App\Console\Commands;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Console\Command;

class AssignCategoriesToCourses extends Command
{
    protected $signature = 'courses:assign-categories';
    protected $description = 'Assign categories to existing courses that don\'t have categories';

    public function handle()
    {
        $courses = Course::whereNull('category_id')->get();
        $categories = Category::all();

        if ($courses->isEmpty()) {
            $this->info('All courses already have categories assigned.');
            return;
        }

        $this->info("Found {$courses->count()} courses without categories.");

        foreach ($courses as $course) {
            // Assign a random category
            $randomCategory = $categories->random();
            $course->update(['category_id' => $randomCategory->id]);
            $this->line("Assigned '{$randomCategory->name}' to course: {$course->title}");
        }

        $this->info('Categories assigned successfully!');
    }
} 