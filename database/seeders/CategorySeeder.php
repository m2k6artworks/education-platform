<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'UI/UX Design',
                'description' => 'Learn the fundamentals of user interface and user experience design',
                'icon' => 'design-course-2.png',
                'color' => '#007bff'
            ],
            [
                'name' => 'Programming',
                'description' => 'Master various programming languages and development frameworks',
                'icon' => 'code-course.png',
                'color' => '#28a745'
            ],
            [
                'name' => 'Graphic Design',
                'description' => 'Create stunning visual designs and digital artwork',
                'icon' => 'design-course-2.png',
                'color' => '#ffc107'
            ],
            [
                'name' => 'Cloud Computing',
                'description' => 'Explore cloud technologies and infrastructure management',
                'icon' => 'cloud-course.png',
                'color' => '#17a2b8'
            ],
            [
                'name' => 'Blockchain',
                'description' => 'Learn about blockchain technology and cryptocurrency',
                'icon' => 'blockchain-course.png',
                'color' => '#6f42c1'
            ],
            [
                'name' => 'Art & Creative',
                'description' => 'Express your creativity through various art forms',
                'icon' => 'design-course-2.png',
                'color' => '#e83e8c'
            ],
            [
                'name' => 'Management',
                'description' => 'Develop leadership and project management skills',
                'icon' => 'cloud-course.png',
                'color' => '#fd7e14'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
} 