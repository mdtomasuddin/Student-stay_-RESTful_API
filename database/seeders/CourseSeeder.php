<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create the Main Course
        $courseId = DB::table('courses')->insertGetId([
            'title'       => 'StudentStay Learning Path',
            'description' => 'A comprehensive guide for student accommodation and business scaling.',
            'thumbnail'   => "https://images.unsplash.com/photo-1501504905252-473c47e087f8?q=80&w=1074&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
            'status'      => 'active',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        // Create the Modules based on the sidebar list
        $modules = [
            ['title' => 'Start Here', 'description' => 'Introductory module.'],
            ['title' => 'Context', 'description' => 'Understanding the landscape.'],
            ['title' => 'Stage 0: Improvise (0-1)', 'description' => 'The foundation phase.'],
            ['title' => 'Stage 1: Monetize (0-1)', 'description' => 'Generating first revenue.'],
            ['title' => 'Stage 2: Advertise (0-1)', 'description' => 'Getting the word out.'],
            ['title' => 'Stage 3: Stabilize (1-4)', 'description' => 'Consistency is key.'],
            ['title' => 'Stage 4: Prioritize (5-9)', 'description' => 'Focusing on what works.'],
            ['title' => 'Stage 5: Productize (10-19)', 'description' => 'Turning service into product.'],
            ['title' => 'Stage 6: Optimize (20-49)', 'description' => 'Improving efficiency.'],
            ['title' => 'Stage 7: Categorize (50-99)', 'description' => 'Organizing your assets.'],
            ['title' => 'Stage 8: Specialize (100-249)', 'description' => 'Niche dominance.'],
            ['title' => 'Stage 9: Capitalize (250-500)', 'description' => 'Scaling to the max.'],
            ['title' => 'Free Bonus', 'description' => 'Extra resources.'],
        ];

        foreach ($modules as $module) {
            DB::table('modules')->insert([
                'course_id'   => $courseId,
                'title'       => $module['title'],
                'description' => $module['description'],
            ]);
        }
    }
}
