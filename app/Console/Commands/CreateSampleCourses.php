<?php

namespace App\Console\Commands;

use App\Models\Course;
use App\Models\Category;
use App\Models\User;
use Illuminate\Console\Command;

class CreateSampleCourses extends Command
{
    protected $signature = 'courses:create-samples';
    protected $description = 'Create sample courses with different categories for testing';

    public function handle()
    {
        $categories = Category::all();
        $users = User::all();

        if ($users->isEmpty()) {
            $this->error('No users found. Please run the database seeder first.');
            return;
        }

        $sampleCourses = [
            [
                'title' => 'Laravel Web Development Masterclass',
                'description' => 'Learn Laravel framework from basics to advanced concepts including authentication, database relationships, and API development.',
                'category' => 'Programming'
            ],
            [
                'title' => 'UI/UX Design Fundamentals',
                'description' => 'Master the principles of user interface and user experience design with practical projects.',
                'category' => 'UI/UX Design'
            ],
            [
                'title' => 'Adobe Photoshop for Beginners',
                'description' => 'Learn Photoshop from scratch and create stunning digital artwork and designs.',
                'category' => 'Graphic Design'
            ],
            [
                'title' => 'AWS Cloud Practitioner',
                'description' => 'Get certified in AWS Cloud Practitioner and learn cloud computing fundamentals.',
                'category' => 'Cloud Computing'
            ],
            [
                'title' => 'Blockchain Development Basics',
                'description' => 'Introduction to blockchain technology and smart contract development.',
                'category' => 'Blockchain'
            ],
            [
                'title' => 'Digital Art Mastery',
                'description' => 'Create beautiful digital art using various tools and techniques.',
                'category' => 'Art & Creative'
            ],
            [
                'title' => 'Project Management Professional',
                'description' => 'Learn project management methodologies and get PMP certified.',
                'category' => 'Management'
            ]
        ];

        foreach ($sampleCourses as $courseData) {
            $category = $categories->where('name', $courseData['category'])->first();
            $user = $users->random();

            Course::create([
                'title' => $courseData['title'],
                'description' => $courseData['description'],
                'thumbnail' => '-',
                'status' => 'approved',
                'user_id' => $user->id,
                'category_id' => $category->id,
            ]);

            $this->line("Created course: {$courseData['title']} in category: {$courseData['category']}");
        }

        $this->info('Sample courses created successfully!');
    }
} 