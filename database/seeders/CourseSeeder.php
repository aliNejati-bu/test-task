<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            [
                'name' => 'math',
                'price' => 3000
            ],
            [
                'name' => 'algebra',
                'price' => 5000
            ]
        ];

        foreach ($courses as $course) {
            Course::query()->create($course);
        }
    }
}
